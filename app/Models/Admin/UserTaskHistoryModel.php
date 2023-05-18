<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTaskHistoryModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'task_id', 'status_id'];
}
