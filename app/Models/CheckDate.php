<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckDate extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'deadline', 'count'];
}
