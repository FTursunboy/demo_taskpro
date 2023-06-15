<?php

namespace App\Models;

use App\Models\Admin\StatusesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemIdea extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'user_id', 'status_id', 'comment', 'file', 'file_name'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(StatusesModel::class, 'status_id');
    }
}
