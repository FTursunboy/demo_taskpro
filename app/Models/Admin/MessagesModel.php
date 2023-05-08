<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessagesModel extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'sender_id', 'message'];
}
