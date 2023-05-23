<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'lastname', 'phone', 'email', 'position', 'client_id', 'lead_source_id'];
}
