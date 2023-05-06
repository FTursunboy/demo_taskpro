<?php

namespace App\Models\Admin;

use App\Http\Controllers\Admin\ProjectTypeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'type_id',
        'time',
        'from',
        'to',
        'start',
        'finish',
        'comment',
        'pro_status',
        'status',
    ];

    public function type(){
        return $this->belongsTo(ProjectTypeModel::class);
    }
    public function status(){
        return $this->belongsTo(StatusesModel::class,'pro_status');
    }
}
