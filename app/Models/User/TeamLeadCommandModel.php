<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeamLeadCommandModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'project_id', 'teamLead_id'];

    public function myCommand($userID)
    {
        return DB::table('team_lead_command_models AS tm')
            ->join('users AS u', 'tm.user_id', '=', 'u.id')
            ->join('project_models AS p', 'tm.project_id', '=', 'p.id')
            ->join('users AS t', 'tm.teamLead_id', '=', 't.id')
            ->select('u.id', 'u.name', 'u.surname', 'u.lastname', 'p.name as project', 'p.id as pro_id')
            ->where('tm.teamLead_id', $userID)
            ->get();
    }
}
