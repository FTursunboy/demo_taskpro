<?php

namespace App\Models\Admin\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nette\Utils\Type;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['fio', 'description', 'date', 'time', 'type_event_id', 'themeEvent_id', 'contact_id', 'slug'];

    public function typeEvent()
    {
        return $this->belongsTo(TypeEvent::class);
    }

    public function themeEvent()
    {
        return $this->belongsTo(ThemeEvent::class, 'themeEvent_id');
    }



}
