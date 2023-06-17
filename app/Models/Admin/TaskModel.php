<?php

namespace App\Models\Admin;

use App\Models\CheckDate;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;

class TaskModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'time',
        'from',
        'to',
        'file',
        'file_name',
        'project_id',
        'type_id',
        'kpi_id',
        'user_id',
        'author_id',
        'client_id',
        'status_id',
        'cancel',
        'cancel_admin',
        'offer_id',
        'comment',
        'slug',
        'percent',
        'finish',
        'success_desc'
    ];


    public function project()
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public function type()
    {
        return $this->belongsTo(TaskTypeModel::class);
    }

    public function typeType()
    {
        return $this->belongsTo(TaskTypesTypeModel::class, 'kpi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusesModel::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function checkDate()
    {
        return $this->hasOne(CheckDate::class, 'task_id');
    }

    public function count_task()
    {
        $projectId = $this->id;
        return TaskModel::where('project_id', $projectId)->orderBy('count', 'desc')->count();
    }


}

