<?php

namespace App\Models;

use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'user_id', 'client_id', 'status_id', 'type', 'sender_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function status() {
        return $this->belongsTo(Statuses::class);
    }

    public function task() {
        return $this->belongsTo(TaskModel::class, 'task_id');
    }
    public function project() {
        return $this->belongsTo(TaskModel::class, 'task_id');
    }

    public function offer() {
        return $this->belongsTo(Offer::class, 'task_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
