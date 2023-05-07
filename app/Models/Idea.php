<?php

namespace App\Models;

use App\Models\Admin\StatusesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Idea extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'slug', 'title', 'description', 'budget', 'pluses', 'minuses', 'from', 'to', 'file', 'comments', 'status_id', 'status'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(StatusesModel::class);
    }
}
