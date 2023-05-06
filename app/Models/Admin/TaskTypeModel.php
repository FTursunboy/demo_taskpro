<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTypeModel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];
}
