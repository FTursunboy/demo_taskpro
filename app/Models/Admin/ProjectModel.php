<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'type_id',
        'time',
        'from',
        'to',
        'start',
        'finish',
        'comment',
        'pro_status',
        'status',
    ];
}
