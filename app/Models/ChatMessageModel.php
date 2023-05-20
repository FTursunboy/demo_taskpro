<?php

namespace App\Models;

use App\Models\Admin\TaskModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessageModel extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'message', 'user_id', 'offer_id'];

    public function tasks()
    {
        return $this->belongsTo(TaskModel::class, 'task_id', 'id');
    }
}
