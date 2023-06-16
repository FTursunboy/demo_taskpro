<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotesModels extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'user_id'];

}
