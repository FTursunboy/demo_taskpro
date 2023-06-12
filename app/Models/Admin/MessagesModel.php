<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessagesModel extends Model
{
    use HasFactory;

    protected $fillable = ['task_slug', 'user_id', 'sender_id', 'message', 'file', 'file_name'];




    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function task() {
        return $this->belongsTo(TaskModel::class, 'task_slug');
    }

}
