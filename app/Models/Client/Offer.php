<?php

namespace App\Models\Client;

use App\Models\Admin\StatusesModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug', 'description', 'author_name', 'author_phone', 'from', 'to', 'file', 'file_name', 'user_id', 'client_id', 'status_id', 'is_finished', 'time'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(StatusesModel::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }


}
