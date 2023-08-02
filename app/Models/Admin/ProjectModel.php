<?php

namespace App\Models\Admin;

use App\Http\Controllers\Admin\ProjectTypeController;
use App\Models\Client\Offer;
use App\Models\Types;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type_id',
        'time',
        'from',
        'to',
        'start',
        'finish',
        'comment',
        'pro_status',
        'status',
        'types_id',
        'file',
        'file_name',
        'is_active'
    ];

    public function type()
    {
        return $this->belongsTo(ProjectTypeModel::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusesModel::class, 'pro_status');
    }

    public function types()
    {
        return $this->belongsTo(Types::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function tasks()
    {
        return $this->hasOne(TaskModel::class, 'project_id');
    }

    public function tasks_user()
    {
        return $this->hasOne(TaskModel::class, 'project_id');
    }

    //TODO: Start - Проект (админ)
    use Illuminate\Support\Facades\Auth;

// ...

    public function count_task()
    {
        return cache()->remember('count_task', 300, function () {
            return $this->tasks()->count();
        });
    }

    public function count_ready()
    {
        return cache()->remember('count_ready', 300, function () {
            return $this->tasks()->where('status_id', 3)->count();
        });
    }

    public function count_process()
    {
        return cache()->remember('count_process', 300, function () {
            $process = $this->tasks()->where('status_id', 4)->count();
            $accept = $this->tasks()->where('status_id', 2)->count();
            return $process + $accept;
        });
    }

    public function count_verificateClient()
    {
        return cache()->remember('count_verificateClient', 300, function () {
            return $this->tasks()->where('status_id', 10)->count();
        });
    }

    public function count_verificateAdmin()
    {
        return cache()->remember('count_verificateAdmin', 300, function () {
            $verificateAdminCount = $this->tasks()->where('status_id', 6)->count();
            $verificateCount = $this->tasks()->where('status_id', 14)->count();
            return $verificateAdminCount + $verificateCount;
        });
    }

    public function count_outOfDate()
    {
        return cache()->remember('count_outOfDate', 300, function () {
            return $this->tasks()->where('status_id', 7)->count();
        });
    }

    public function count_other()
    {
        return cache()->remember('count_other', 300, function () {
            $expected = $this->tasks()->where('status_id', 1)->count();
            $rejected = $this->tasks()->where('status_id', 5)->count();
            $expectedAdmin = $this->tasks()->where('status_id', 8)->count();
            $expectedUser = $this->tasks()->where('status_id', 9)->count();
            $rejectedAdmin = $this->tasks()->where('status_id', 11)->count();
            $rejectedUser = $this->tasks()->where('status_id', 12)->count();
            $rejectedClient = $this->tasks()->where('status_id', 13)->count();
            return $expected + $rejected + $expectedAdmin + $expectedUser + $rejectedAdmin + $rejectedUser + $rejectedClient;
        });
    }

// ...

//TODO: Start - Проект (сотрудник)
    public function count_task_user()
    {
        return cache()->remember('count_task_user_' . Auth::id(), 300, function () {
            return $this->tasks()->where('user_id', Auth::id())->count();
        });
    }

    public function count_ready_user()
    {
        return cache()->remember('count_ready_user_' . Auth::id(), 300, function () {
            return $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 3)->count();
        });
    }

    public function count_process_user()
    {
        return cache()->remember('count_process_user_' . Auth::id(), 300, function () {
            $process = $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 4)->count();
            $accept = $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 2)->count();
            return $process + $accept;
        });
    }

    public function count_verificateClient_user()
    {
        return cache()->remember('count_verificateClient_user_' . Auth::id(), 300, function () {
            return $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 10)->count();
        });
    }

    public function count_verificateAdmin_user()
    {
        return cache()->remember('count_verificateAdmin_user_' . Auth::id(), 300, function () {
            $verificateAdminCount = $this->tasks()->where('user_id', Auth::id())->where('status_id', 6)->count();
            $verificateCount = $this->tasks()->where('user_id', Auth::id())->where('status_id', 14)->count();
            return $verificateAdminCount + $verificateCount;
        });
    }

    public function count_outOfDate_user()
    {
        return cache()->remember('count_outOfDate_user_' . Auth::id(), 300, function () {
            return $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 7)->count();
        });
    }

    public function count_other_user()
    {
        return cache()->remember('count_other_user_' . Auth::id(), 300, function () {
            $expected = $this->tasks()->where('user_id', Auth::id())->where('status_id', 1)->count();
            $rejected = $this->tasks()->where('user_id', Auth::id())->where('status_id', 5)->count();
            $expectedAdmin = $this->tasks()->where('user_id', Auth::id())->where('status_id', 8)->count();
            $expectedUser = $this->tasks()->where('user_id', Auth::id())->where('status_id', 9)->count();
            $rejectedAdmin = $this->tasks()->where('user_id', Auth::id())->where('status_id', 11)->count();
            $rejectedUser = $this->tasks()->where('user_id', Auth::id())->where('status_id', 12)->count();
            $rejectedClient  = $this->tasks()->where('user_id', Auth::id())->where('status_id', 13)->count();

            return $expected + $rejected + $expectedAdmin + $expectedUser + $rejectedAdmin + $rejectedUser + $rejectedClient;
            });
    }
    //TODO: End - Проект (сотрудник)


}
