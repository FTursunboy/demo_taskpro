<?php

namespace App\Models\Admin\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeEvent extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
