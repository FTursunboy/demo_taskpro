<?php

namespace App\Models;

use App\Models\Admin\ProjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectClient extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'project_id'];

    public function projects(){
        return $this->belongsTo(ProjectModel::class, 'project_id');
    }
}
