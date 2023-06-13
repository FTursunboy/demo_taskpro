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
        return TaskModel::orderBy('count', 'desc')->count();
    }





}
