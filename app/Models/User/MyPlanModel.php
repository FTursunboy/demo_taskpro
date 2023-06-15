<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyPlanModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'hour', 'date','status', 'user_id'];
}
