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

    public function userInCommand($userID)
    {
        return DB::table('team_lead_command_models AS tm')
            ->join('users AS u', 'tm.user_id', '=', 'u.id')
            ->select('u.id', 'u.name', 'u.surname', 'u.lastname')
            ->where('tm.teamLead_id', $userID)
            ->groupBy('u.id', 'u.name', 'u.surname', 'u.lastname')
            ->get();
    }

    public function userTaskList($teamLeadID)
    {
        return DB::table('task_models as t')
            ->select('u.id as user_id', 't.created_at', 'u.name', 'u.surname', 'u.lastname', 't.id as task_id', 't.name as task', 't.slug as slug', 'sts.name as sts', 'sts.id as status_id', 'p.name as group')
            ->join('project_models as p', 't.project_id', '=', 'p.id')
            ->join('statuses_models as sts', 't.status_id', '=', 'sts.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->whereIn('t.user_id', function ($query) use   ($teamLeadID) {
                $query->select('tlc.user_id')
                    ->from('team_lead_command_models as tlc')
                    ->where('tlc.teamLead_id', $teamLeadID);
            })
            ->whereIn('t.project_id', function ($query) use ($teamLeadID) {
                $query->select('tlc.project_id')
                    ->from('team_lead_command_models as tlc')
                    ->where('tlc.teamLead_id', $teamLeadID);
            })
            ->where('t.deleted_at', '=', null)
            ->get();
    }


}
