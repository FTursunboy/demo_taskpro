<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyPlanModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'hour', 'date','status', 'user_id'];
}
