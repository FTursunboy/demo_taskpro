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

    public function type(){
        return $this->belongsTo(ProjectTypeModel::class);
    }
    public function status(){
        return $this->belongsTo(StatusesModel::class,'pro_status');
    }
    public function types() {
        return $this->belongsTo(Types::class);
    }

    public function users(){
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
    public function count_task()
    {
        return $this->tasks()->count();
    }

    public function count_ready()
    {
        return $this->tasks()->where('status_id', '=', 3)->count();
    }

    public function count_process()
    {
       $process =  $this->tasks()->where('status_id', '=', 4)->count();
       $accept  =  $this->tasks()->where('status_id', '=', 2)->count();

       return $process + $accept;
    }

    public function count_verificateClient()
    {
        return $this->tasks()->where('status_id', '=', 10)->count();
    }

    public function count_verificateAdmin()
    {
        $verificateAdminCount = $this->tasks()->where('status_id', 6)->count();
        $verificateCount      = $this->tasks()->where('status_id', 14)->count();

        return $verificateAdminCount + $verificateCount;
    }

    public function count_outOfDate()
    {
        return $this->tasks()->where('status_id', '=', 7)->count();
    }

    public function count_other()
    {
        $expected        = $this->tasks()->where('status_id', 1)->count();
        $rejected        = $this->tasks()->where('status_id', 5)->count();
        $expectedAdmin   = $this->tasks()->where('status_id', 8)->count();
        $expectedUser    = $this->tasks()->where('status_id', 9)->count();
        $rejectedAdmin   = $this->tasks()->where('status_id', 11)->count();
        $rejectedUser    = $this->tasks()->where('status_id', 12)->count();
        $rejectedClient  = $this->tasks()->where('status_id', 13)->count();

        return $expected + $rejected + $expectedAdmin + $expectedUser + $rejectedAdmin + $rejectedUser + $rejectedClient;
    }
    //TODO: End - Проект (админ)

    //TODO: Start - Проект (сотрудник)
    public function count_task_user()
    {
        return $this->tasks()->where('user_id', Auth::id())->count();
    }

    public function count_ready_user()
    {
        return $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 3)->count();
    }

    public function count_process_user()
    {
       $process =  $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 4)->count();
       $accept  =  $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 2)->count();

       return $process + $accept;
    }

    public function count_verificateClient_user()
    {
        return $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 10)->count();
    }

    public function count_verificateAdmin_user()
    {
        $verificateAdminCount = $this->tasks()->where('user_id', Auth::id())->where('status_id', 6)->count();
        $verificateCount      = $this->tasks()->where('user_id', Auth::id())->where('status_id', 14)->count();

        return $verificateAdminCount + $verificateCount;
    }

    public function count_outOfDate_user()
    {
        return $this->tasks()->where('user_id', Auth::id())->where('status_id', '=', 7)->count();
    }

    public function count_other_user()
    {
        $expected        = $this->tasks()->where('user_id', Auth::id())->where('status_id', 1)->count();
        $rejected        = $this->tasks()->where('user_id', Auth::id())->where('status_id', 5)->count();
        $expectedAdmin   = $this->tasks()->where('user_id', Auth::id())->where('status_id', 8)->count();
        $expectedUser    = $this->tasks()->where('user_id', Auth::id())->where('status_id', 9)->count();
        $rejectedAdmin   = $this->tasks()->where('user_id', Auth::id())->where('status_id', 11)->count();
        $rejectedUser    = $this->tasks()->where('user_id', Auth::id())->where('status_id', 12)->count();
        $rejectedClient  = $this->tasks()->where('user_id', Auth::id())->where('status_id', 13)->count();

        return $expected + $rejected + $expectedAdmin + $expectedUser + $rejectedAdmin + $rejectedUser + $rejectedClient;
    }
   //TODO: End - Проект (сотрудник)


}
