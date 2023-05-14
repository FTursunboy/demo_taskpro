<?php

namespace App\Models\Admin;

use App\Models\Statuses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TasksClient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'from',
        'to',
        'file',
        'file_name',
        'status_id',
        'client_id',
        'cansel',
    ];
    protected $table = 'tasks_client';

    public function status() {
        return $this->belongsTo(StatusesModel::class);
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
}
