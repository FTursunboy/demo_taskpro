<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'comment',
        'start',
        'finish',
        'project_id',
        'type_id',
        'kpi_id',
        'user_id',
        'client_id',
        'status_id',
        'status',
        'slug'
    ];

    public function type() {
        return $this->belongsTo(TaskTypeModel::class);
    }

    public function kpi() {
        return $this->belongsTo(TaskTypesTypeModel::class);
    }
    public function status() {
        return $this->belongsTo(StatusesModel::class);
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function project() {
        return $this->belongsTo(ProjectModel::class);
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }


}
