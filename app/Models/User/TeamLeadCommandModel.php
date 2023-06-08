<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeamLeadCommandModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'project_id', 'teamLead_id'];

    public function myCommand($userID, $projectID)
    {
        return DB::table('team_lead_command_models AS tm')
            ->join('users AS u', 'tm.user_id', '=', 'u.id')
            ->join('project_models AS p', 'tm.project_id', '=', 'p.id')
            ->join('users AS t', 'tm.teamLead_id', '=', 't.id')
            ->select('u.id', 'u.name', 'u.surname', 'u.lastname', 'p.name as project', 'p.id as pro_id')
            ->where('tm.teamLead_id', $userID)
            ->where('tm.project_id', $projectID)
            ->get();
    }

    public function commandProjects($userID)
    {
        return DB::table('team_lead_command_models AS tlc')
            ->join('project_models AS p', 'tlc.project_id', '=', 'p.id')
            ->select('p.id as project_id', 'p.name', 'p.finish')
            ->distinct()
            ->where('tlc.teamLead_id', $userID)
            ->get();

    }
    public function userInCommand($userID){
        return DB::table('team_lead_command_models AS tm')
            ->join('users AS u', 'tm.user_id', '=', 'u.id')
            ->select('u.id', 'u.name', 'u.surname', 'u.lastname')
            ->where('tm.teamLead_id', $userID)
            ->groupBy('u.id', 'u.name', 'u.surname', 'u.lastname')
            ->get();
    }

    public function userTaskList($teamLeadID){
        return DB::table('team_lead_command_models AS tlc')
            ->join('users AS u', 'tlc.user_id', '=', 'u.id')
            ->join('task_models AS t', 'u.id', '=', 't.user_id')
            ->join('statuses_models AS sts', 't.status_id', '=', 'sts.id')
            ->join('project_models AS p', 't.project_id', '=', 'p.id')
            ->select('u.id AS user_id', 'u.name', 'u.surname', 'u.lastname', 't.id AS task_id', 't.name AS task', 'sts.name AS sts', 'p.name AS project')
            ->where('tlc.teamLead_id', $teamLeadID)
//            ->groupBy('tlc.user_id')
            ->groupBy('u.id', 'u.name', 'u.surname', 'u.lastname', 't.id', 't.name', 'sts.name', 'p.name')
            ->distinct()
            ->get();

    }

}
