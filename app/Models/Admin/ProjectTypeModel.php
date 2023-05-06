<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTypeModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'status'];
}
