<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'user_id', 'task_id'];
}
