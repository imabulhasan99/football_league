<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\AddLeague;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AddLeagueController extends Controller
    {
    public function index(){
        $countries = DB::table('countries')->get();
        return view('admin.pages.league.add-league', ['countries' => $countries ]);
    }


    public function create(AddLeague $request)
    {

        $validatedData = $request->validated();
        $existingLeague = DB::table('leagues')->where('name', $validatedData['league_name'])->first();
        if ($existingLeague) {
            return redirect()->back()->with('league-success', 'League with this name already exists');
        }

        if ($request->hasFile('league_flag')) {
            $file = $request->file('league_flag');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $fullPath = $file->storeAs('uploads/league_flag', $fileName, 'public');
        } else {
            $fileName = null;
        }

        DB::table('leagues')->insert([
            'name'              => $validatedData['league_name'],
            'league_country'    => $validatedData['league_country'],
            'league_flag'       =>  $fileName,
            'uuid'              => Str::uuid(),
        ]);
    
        return redirect()->back()->with('league-success', 'League Added Successfully');
    }
    
    public function  editLeague($uuid)
    {
        $existingLeague = DB::table('leagues')
        ->join('countries','leagues.league_country','=','countries.id')
        ->select('leagues.*','countries.country_name')
        ->where('leagues.uuid',$uuid)->first();
        $countires =  DB::table('countries')->get();
        
        return view('admin.pages.league.edit-league', ['leagueinfo' => $existingLeague, 'countries' =>  $countires]);
    }


    
    public function updateLeague(AddLeague $request, $uuid)
    {
        $validatedData  = $request->validated();
        $league = DB::table('leagues')->where('uuid', $uuid)->first();

    
        if (!$league) {
            return redirect()->back()->with('error', 'League not found');
        }

    
        if ($request->hasFile('league_flag')) {
        
            if ($league->league_flag) {
                Storage::disk('public')->delete('uploads/league_flag/' . $league->league_flag);
            }

            $file = $request->file('league_flag');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/league_flag', $fileName, 'public');
        } else {
        
            $fileName = null;
        }

    
        DB::table('leagues')
            ->where('uuid', $uuid)
            ->update([
                'name'              => $validatedData['league_name'],
                'league_country'    => $validatedData['league_country'],
                'league_flag'       => $fileName,
                'updated_at'        => now()
            ]);


        return redirect()->route('league.all')->with('league-update-success', 'League updated successfully');
    }


    public function deleteLeague(Request $request, $uuid)
    {
        DB::table('leagues')->where('uuid', $uuid)->delete();

        return redirect()->back()->with('league-delete-success', 'League deleted successfully');
    }


    public function allLeague()
    {
        $leagues = DB::table('leagues')
        ->join('countries','leagues.league_country','=','countries.id')
        ->select('leagues.*','countries.country_name')
        ->get();
        return view('admin.pages.league.all-league', ['leagues' => $leagues ]);
    }


}
