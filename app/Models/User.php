<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TasksClient;
use App\Models\Client\Offer;
use App\Models\User\TeamLeadCommandModel;
use App\Models\Users\NotesModels;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'lastname',
        'login',
        'password',
        'phone',
        'position',
        'otdel_id',
        'telegram_user_id',
        'status',
        'xp',
        'slug',
        'avatar',
        'role',
        'email',
        'client_id',
        'birthday',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function otdel()
    {
        return $this->belongsTo(OtdelsModel::class);
    }

    public function taskCount($id)
    {
        return TaskModel::where('user_id', $id)->count();
    }

    public function taskSuccessCount($id)
    {
        return TaskModel::where('user_id', $id)->where('status_id', 3)->count();
    }

    public function taskClientCount($id)
    {
        return Offer::where('client_id', $id)->count();
    }

    public function taskClientSuccessCount($id)
    {
        return TasksClient::where('client_id', $id)->where('status_id', 3)->count();
    }

    public function ideaCount($id)
    {
        return Idea::where('user_id', $id)->count();
    }

    public function tasksSuccess($id)
    {
        return TaskModel::where('user_id', $id)->where('status_id', 3)->orderBy('to', 'desc')->get();
    }

    // profile
    public function projectCount()
    {
        return ProjectModel::count();
    }

    public function clientCount()
    {
        return User::role('client')->count();
    }

    public function ideaCountProfile()
    {
        return Idea::count();
    }


    public function countTasks($id)
    {
        $success = TaskModel::where('status_id', 3)->where('user_id', $id)->count();
        $inProgress = TaskModel::where('status_id', 4)->where('user_id', $id)->whereIn('id', function ($query) {
            $query->from('user_task_history_models as h')
                ->select('h.task_id')
                ->where('h.status_id', 4);
        })->count();
        $speed = TaskModel::where('status_id', 7)->where('user_id', $id)->count();
        $all = TaskModel::where('user_id', $id)->count();
        $verificate = TaskModel::where('status_id', 10)
            ->where('client_id', Auth::id())->count();
        $new = TaskModel::where('task_models.user_id', $id)
            ->whereIn('task_models.status_id', [1, 7, 9])
            ->whereNotIn('task_models.id', function ($subquery) use ($id) {
                $subquery->select('h.task_id')
                    ->from('user_task_history_models as h')
                    ->where('h.user_id', $id);
            })
            ->count();
        return [
            'success' => $success,
            'inProgress' => $inProgress,
            'speed' => $speed,
            'all' => $all,
            'verificate' => $verificate,
            'new' => $new
        ];
    }

    public function getNewTasks($id)
    {
        $tasks = TaskModel::where('task_models.user_id', $id)
            ->whereIn('task_models.status_id', [1, 7, 9])
            ->whereNotIn('task_models.id', function ($subquery) use ($id) {
                $subquery->select('h.task_id')
                    ->from('user_task_history_models as h')
                    ->where('h.user_id', $id);
            })
            ->orderBy('task_models.status_id', 'desc')
            ->get();

        return $tasks;
    }

    public function offers($id)
    {
        $offers = Offer::where([
            'user_id' => $id,
            'status_id' => 1
        ]);

        return $offers;

    }

    public function getUsersTasks($id)
    {
        TaskModel::where('task_models.user_id', $id)
            ->orderByRaw('task_models.status_id = 3 ASC')
            ->whereNotIn('task_models.id', function ($subquery) use ($id) {
                $subquery->from('user_task_history_models as h')
                    ->select('h.task_id')
                    ->where('h.status_id', '=', 3);
            })
            ->orderBy('task_models.status_id', 'desc')
            ->get();

        return TaskModel::whereIn('id', function ($query) use ($id) {
            $query->select('task_id')
                ->from('user_task_history_models')
                ->where('user_id', '=', $id);
        })
            ->whereIn('status_id', [2, 4, 7])
            ->get();

    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }

    public function projects()
    {
        return $this->belongsToMany(ProjectModel::class);
    }


    public function all_offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function tasks()
    {
        return $this->hasMany(Offer::class);
    }

    public function clientEmail()
    {
        return $this->hasOne(ClientMail::class, 'user_id');
    }


    public function UserSumKPI($userID)
    {
        $result = DB::table('task_models')
            ->where('user_id', $userID)
            ->sum('percent');

        return $result;
    }

    public function offerss()
    {
        return $this->hasMany(Offer::class);
    }

    public function TeamLeadProject()
    {
        return DB::table('team_lead_command_models AS tlc')
            ->select('tlc.teamLead_id', 'p.NAME AS pro_name', 'u.name',  'u.avatar', 'u.surname', 'u.lastname',  DB::raw('COUNT(t.id) AS task_count'))
            ->join('project_models AS p', 'tlc.project_id', '=', 'p.id')
            ->join('users AS u', 'tlc.teamLead_id', '=', 'u.id')
            ->join('task_models AS t', 'tlc.project_id', '=', 't.id')
            ->groupBy('tlc.teamLead_id', 'p.NAME',  'u.avatar', 'u.surname', 'u.lastname',  'u.name')
            ->get();
    }



    public function notesList($userID)
    {
        return NotesModels::where('user_id', $userID)->get();
    }

    public function usersCountTasks($id)
    {
        $statusIds = [2, 4, 3, 1, 7, 8, 9, 10, 14, 6, 5, 11, 13, 12];

        $counts = TaskModel::where('user_id', $id)
            ->whereIn('status_id', $statusIds)
            ->selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as debt,
            SUM(CASE WHEN status_id = 2 THEN 1 ELSE 0 END) as process,
            SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as accept,
            SUM(CASE WHEN status_id = 3 THEN 1 ELSE 0 END) as ready,
            SUM(CASE WHEN status_id = 1 THEN 1 ELSE 0 END) as expected,
            SUM(CASE WHEN status_id = 7 THEN 1 ELSE 0 END) as speed,
            SUM(CASE WHEN status_id = 8 THEN 1 ELSE 0 END) as expectedAdmin,
            SUM(CASE WHEN status_id = 9 THEN 1 ELSE 0 END) as expectedUser,
            SUM(CASE WHEN status_id = 10 THEN 1 ELSE 0 END) as forVerificationClient,
            SUM(CASE WHEN status_id = 14 THEN 1 ELSE 0 END) as forVerificationAdmin,
            SUM(CASE WHEN status_id = 6 THEN 1 ELSE 0 END) as forVerification,
            SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as rejected,
            SUM(CASE WHEN status_id = 11 THEN 1 ELSE 0 END) as rejectedAdmin,
            SUM(CASE WHEN status_id = 13 THEN 1 ELSE 0 END) as rejectedClient,
            SUM(CASE WHEN status_id = 12 THEN 1 ELSE 0 END) as rejectedUser
        ")
            ->first();

        return $counts->toArray();
    }


    public static function getUserTasksInMonth($month, $id)
    {
        $startOfMonth = Carbon::now()->month($month)->startOfMonth();
        $endOfMonth = Carbon::now()->month($month)->endOfMonth();

        $statusIds = [2, 4, 3, 1, 7, 8, 9, 10, 14, 6, 5, 11, 13, 12];
        $tasks = TaskModel::where('user_id', $id)
            ->whereIn('status_id', $statusIds)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status_id IN (4, 7) THEN 1 ELSE 0 END) as debt,
           SUM(CASE WHEN status_id IN (4, 2) THEN 1 ELSE 0 END) as process,
            SUM(CASE WHEN status_id = 3 THEN 1 ELSE 0 END) as ready,
            SUM(CASE WHEN status_id = 7 THEN 1 ELSE 0 END) as speed,
            SUM(CASE WHEN status_id IN(1, 8) THEN 1 ELSE 0 END) as expectedAdmin,
            SUM(CASE WHEN status_id = 9 THEN 1 ELSE 0 END) as expectedUser,
            SUM(CASE WHEN status_id = 10 THEN 1 ELSE 0 END) as forVerificationClient,
            SUM(CASE WHEN status_id IN(6, 14) THEN 1 ELSE 0 END) as forVerificationAdmin,
            SUM(CASE WHEN status_id IN(5, 11) THEN 1 ELSE 0 END) as rejectedAdmin,
            SUM(CASE WHEN status_id = 13 THEN 1 ELSE 0 END) as rejectedClient,
            SUM(CASE WHEN status_id = 12 THEN 1 ELSE 0 END) as rejectedUser
        ")
            ->first();

        return $tasks;
    }



}
