<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TasksClient;
use App\Models\Client\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
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
        $UnSuccess = TaskModel::where('status_id', 5)->where('user_id', $id)->whereIn('id', function ($query) {
            $query->from('user_task_history_models as h')
                ->select('h.task_id')
                ->where('h.status_id', 5);
        })->count();
        $speed = TaskModel::where('status_id', 7)->where('user_id', $id)->count();
        $all = TaskModel::where('user_id', $id)->count();
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
            'unSuccess' => $UnSuccess,
            'speed' => $speed,
            'all' => $all,
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
        return TaskModel::where([
            ['task_models.user_id', $id],
        ])->orderByRaw('task_models.status_id = 3 ASC')
            ->WhereNotIn('task_models.id', function ($subquery) use ($id) {
                $subquery->from('user_task_history_models as h')
                    ->select('h.task_id')
                    ->where('h.status_id', '=', $id)
                    ->where('h.status_id', [3, 7]);
            })
            ->orderBy('task_models.status_id', 'desc')
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


}
