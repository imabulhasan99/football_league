<?php

namespace App\Http\Controllers\Api;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EplController extends Controller
{
        protected $apiService;
   public function __construct(ApiService $apiService)
   {
        $this->apiService = $apiService;
   }

   public function index()
   {
       $url = 'https://api-football-v1.p.rapidapi.com/v3/fixtures?league=39&season=2023';
       $response = $this->apiService->makeRequest($url);
       $response = json_decode($response, true);
   
       DB::beginTransaction();
   
       try {
           foreach ($response['response'] as $value) {
               // Retrieve team IDs
               $homeTeamId = $this->getTeamId($value['teams']['home']['name']);
               $awayTeamId = $this->getTeamId($value['teams']['away']['name']);
   
               // Check if either home or away team ID is null
               if ($homeTeamId === null || $awayTeamId === null) {
                   // Log or handle the case where either team ID is null
                   // For now, let's just continue to the next iteration
                   continue;
               }
   
               // Check if referee information is available
               $referee = $value['fixture']['referee'] ?? null;
   
               // Insert data into the 'fixtures' table
               $fixturesId = DB::table('fixtures')->insertGetId([
                   'leagues_id' => $this->getLeagueId($value['league']['name']),
                   'home_team_id' => $homeTeamId,
                   'away_team_id' => $awayTeamId,
                   'fixture_date' => $value['fixture']['date'],
                   'referee' => $referee,
                   'venue' => $value['fixture']['venue']['name'],
                   'created_at' => now(),
                   'updated_at' => now(),
               ]);
   
               // Insert data into the 'results' table
               DB::table('results')->insert([
                   'fixtures_id' => $fixturesId,
                   'home_team_goals' => $value['goals']['home'],
                   'away_team_goals' => $value['goals']['away'],
                   'home_team_scorers' => $value['scorers']['home'] ?? null,
                   'away_team_scorers' => $value['scorers']['away'] ?? null,
               ]);
           }
   
           DB::commit();
   
       } catch (\Exception $e) {
           // If an exception occurs, rollback the transaction
           DB::rollBack();
           throw $e;
       }
   
       return view('admin.pages.fixtures.epl-fixtures')->with('epl-fixture', 'Epl fixture updated');
   }
   

   
   
   private function getLeagueId($leagueName)
   {
       // Retrieve the league ID based on the league name
       return DB::table('leagues')->where('name', $leagueName)->value('id');
   }
   
   private function getTeamId($teamName)
   {
       // Retrieve the team ID based on the team name
       return DB::table('teams')->where('team_name', $teamName)->value('id');
   }
}
