<?php

namespace App\Models\Admin\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = ['contact_id', 'lead_status_id', 'lead_source_id', 'lead_state_id', 'author', 'description', 'is_client'];


    public function leadSource() {
        return $this->belongsTo(LeadSource::class, 'lead_source_id');
    }
    public function status(){
        return $this->belongsTo(LeadStatus::class, 'lead_status_id');
    }
    public function contacts(){
        return $this->hasMany(Contact::class, 'lead_id');
    }
    public function contact(){
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    public function state() {
        return $this->belongsTo(LeadState::class, 'lead_state_id');
    }
}
