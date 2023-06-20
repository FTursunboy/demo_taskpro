<?php

namespace App\Models;

use App\Models\Client\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    use HasFactory;
    protected $fillable = ['task_slug', 'sender_id', 'text', 'status_id', 'offer_id'];


    public function user() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function offer() {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function status() {
        return $this->belongsTo(Statuses::class, 'status_id');
    }
}
