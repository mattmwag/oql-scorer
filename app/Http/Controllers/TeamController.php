<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Fixture;
use Illuminate\Http\Request;
use DB;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::query()
            ->orderBy('group')
            ->orderBy('name')
            ->paginate(50);

        return view('teams.index', compact('teams'))
            ->with('i', (request()->input('page', 1) - 1) *50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
        ]);

        Team::create($request->all());

        return redirect()->route('teams.index')
            ->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
           'name' => 'required',
           'group' => 'required',
        ]);

        $team->update($request->all());

        return redirect()->route('teams.index')
            ->with('success', 'Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')
            ->with('success', 'Team deleted successfully');
    }

    public function rankings()
    {
        $teams = Team::all();
        foreach ($teams as $team) {
            $f1 = Fixture::where('team_one_id', $team->id)->sum('t1result');
            $f2 = Fixture::where('team_two_id', $team->id)->sum('t2result');
            $team->leaguePoints = $f1 + $f2;
            $t1 = Fixture::where('team_one_id', $team->id)->sum('team_one_score');
            $t1a = Fixture::where('team_one_id', $team->id)->sum('team_two_score');
            $t2 = Fixture::where('team_two_id', $team->id)->sum('team_two_score');
            $t2a = Fixture::where('team_two_id', $team->id)->sum('team_one_score');
            $t1a = Fixture::where('team_one_id', $team->id)->sum('team_two_score');
            $t2a = Fixture::where('team_two_id', $team->id)->sum('team_one_score');
            $cb = Fixture::where('team_one_id', $team->id)->sum('t1p1_score')
                + Fixture::where('team_one_id', $team->id)->sum('t1p2_score')
                + Fixture::where('team_one_id', $team->id)->sum('t1p3_score')
                + Fixture::where('team_one_id', $team->id)->sum('t1p4_score')
                + Fixture::where('team_two_id', $team->id)->sum('t2p1_score')
                + Fixture::where('team_two_id', $team->id)->sum('t2p2_score')
                + Fixture::where('team_two_id', $team->id)->sum('t2p3_score')
                + Fixture::where('team_two_id', $team->id)->sum('t2p4_score');
            $negs = Fixture::where('team_one_id', $team->id)->sum('t1p1_negs')
                + Fixture::where('team_one_id', $team->id)->sum('t1p2_negs')
                + Fixture::where('team_one_id', $team->id)->sum('t1p3_negs')
                + Fixture::where('team_one_id', $team->id)->sum('t1p4_negs')
                + Fixture::where('team_two_id', $team->id)->sum('t2p1_negs')
                + Fixture::where('team_two_id', $team->id)->sum('t2p2_negs')
                + Fixture::where('team_two_id', $team->id)->sum('t2p3_negs')
                + Fixture::where('team_two_id', $team->id)->sum('t2p4_negs');
            $t1c = Fixture::where('team_one_id', '=', $team->id)
                ->where(function ($query) {
                    $query->where('t1result', '>', 0)
                        ->orWhere('t2result', '>', 0);
                })->count();
            $t2c = Fixture::where('team_two_id', '=', $team->id)
                ->where(function ($query) {
                    $query->where('t1result', '>', 0)
                        ->orWhere('t2result', '>', 0);
                })->count();
            $team->pointsPerStarter = ($t1c + $t2c > 0) ?
                ($t1 + $t2) / ($t1c + $t2c) / 20        : 0;
            $team->pointsConcededPerStarter = ($t1c + $t2c > 0) ?
                ($t1a + $t2a) / ($t1c + $t2c) / 20        : 0;
            $team->correctBuzzes = $cb / 20;
            $team->negs = $negs / -10;
            $team->totalPointsFor = $t1 + $t2;
            $team->totalPointsAgainst = $t1a + $t2a;
        }

        $teams = $teams->sortBy([
            ['group', 'asc'],
            ['leaguePoints', 'desc'],
            ['pointsPerStarter', 'desc'],
            ['pointsConcededPerStarter', 'asc'],
            ['correctBuzzes', 'desc'],
            ['negs', 'asc'],
        ]);

        return view('teams.rankings', compact('teams'));
    }
}
