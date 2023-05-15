<?php

namespace App\Models;

use App\Models\Client\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientNotification extends Model
{
    use HasFactory;
    protected $fillable = ['offer_id'];

    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
