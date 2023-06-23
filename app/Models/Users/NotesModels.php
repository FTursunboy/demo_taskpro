<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotesModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['note', 'user_id'];

}
