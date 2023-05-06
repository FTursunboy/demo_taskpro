<?php

namespace App\Models\Admin;

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
        'project_slug',
        'type_id',
        'kpi_id',
        'user_slug',
        'client_slug',
        'status_id',
        'status',
        'slug'
    ];
}
