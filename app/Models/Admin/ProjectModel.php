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
        'file_name'
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
       $accept =  $this->tasks()->where('status_id', '=', 2)->count();

       return $process + $accept;
    }

    public function count_verificateClient()
    {
        return $this->tasks()->where('status_id', '=', 10)->count();
    }

    public function count_verificateAdmin()
    {
        $verificateAdminCount = $this->tasks()->where('status_id', 6)->count();
        $verificateCount = $this->tasks()->where('status_id', 14)->count();

        return $verificateAdminCount + $verificateCount;
    }

    public function count_outOfDate()
    {
        return $this->tasks()->where('status_id', '=', 7)->count();
    }



}
