<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index(){
        $leagues = DB::table("leagues")->get();
        return view('admin.pages.teams.add-team', ['leagues' => $leagues]);
    }

    public function create(TeamRequest $request){
        $validateData = $request->validated();

        $exitsingTeam = DB::table('teams')->where('team_name', $validateData['team_name'])->first();
        
        if ($exitsingTeam)
        {
            return redirect()->back()->with('team-error','This team already exits');
        }

        if ($request->hasFile('team_flag')) 
        {
            $file = $request->file('team_flag');
            $fileName = time() .'.'. $file->getClientOriginalExtension();
            $fullPath = $file->storeAs('uploads/team_flag', $fileName, 'public');
        } else {
            $fileName = null;
        }
        
        $query = DB::table('teams')->insert([
            'team_name'         => $validateData['team_name'],
            'league_id'         => $validateData['league_name'],
            'team_flag'         =>  $fileName,
            'is_top_team'       => $validateData['is_currently_playing'],
            'founded'           => $validateData['founded'],
            'created_at'        => now()
        ]);
        
        return redirect()->back()->with('team-success','Team Added Successfully');
    }   

    public function editTeam($id)
    {
        $existingTeams = DB::table('teams')
        ->join('leagues','teams.league_id','=','leagues.id')
        ->select('teams.*','leagues.name')
        ->where('teams.id',$id)->first();
        $league =  DB::table('leagues')->get();
        
        
        return view('admin.pages.teams.edit-team', ['teaminfo' => $existingTeams, 'leagues' =>  $league]);
    }

    public function updateTeam(TeamRequest $request, $id)
    {
        $validateData = $request->validated();
        $team = DB::table('teams')->where('id', $id)->first();
    
        if (!$team) {
            return redirect()->back()->with('error', 'Team not found');
        }

    
        if ($request->hasFile('team_flag')) {
        
            if ($team->team_flag) {
                Storage::disk('public')->delete('uploads/team_flag/' . $team->team_flag);
            }

            $file = $request->file('team_flag');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/team_flag', $fileName, 'public');
        } else {
        
            $fileName = $team->team_flag;
        }

  
        DB::table('teams')
            ->where('id', $id)
            ->update([
                'team_name'         => $validateData['team_name'],
                'league_id'         => $validateData['league_name'],
                'team_flag'         => $fileName,
                'is_top_team'       => $validateData['is_currently_playing'],
                'founded'           => $validateData['founded'],
                'updated_at'        => now()
            ]);


        return redirect()->route('team.all')->with('team-update-success', 'Team updated successfully');
    }

    public function deleteTeam(Request $request, $id)
    {
        $team = DB::table('teams')->where('id', $id)->first();
        if ($team)
        {
            Storage::disk('public')->delete('uploads/team_flag/' . $team->team_flag);
            DB::table('teams')->where('id', $id)->delete();
        }

        return redirect()->back()->with('team-delete-success', 'Team deleted successfully');
    }

    public function allTeam(){
        $teams = DB::table('teams')
        ->join('leagues','teams.league_id','=','leagues.id')
        ->select('teams.*','leagues.name')
        ->get();
        return view('admin.pages.teams.all-team', ['teams'=> $teams]);
    }
}
