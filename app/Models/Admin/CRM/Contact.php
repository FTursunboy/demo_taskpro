<?php

namespace App\Models\Admin\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['fio', 'phone', 'email', 'position', 'client_id', 'lead_source_id', 'address', 'is_client'];


    public function leadSource() {
        return $this->belongsTo(LeadSource::class, 'lead_source_id');
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function leads() {
        return $this->belongsTo(Lead::class, 'client_id');
    }


}
