<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    const GROUP_COUNT = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fixtures = Fixture::orderBy('round')->paginate(50);

        return view('fixtures.index', compact('fixtures'))
            ->with('i', (request()->input('page', 1) - 1) *50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $round = Fixture::max('round') + 1;

        $bye = Team::where('name', 'Bye')->first();

        for ($i = 1; $i <= self::GROUP_COUNT; $i++) {
            $teams = Team::inRandomOrder()->where('group', $i)->get();
            [$A, $B, $C, $D, $E] = $teams;
            $fixture = new Fixture();

            $this->makeFixture($A, $B, 1);
            $this->makeFixture($C, $D, 1);
            $this->makeFixture($E, $bye, 1);

            $this->makeFixture($B, $C, 2);
            $this->makeFixture($D, $E, 2);
            $this->makeFixture($A, $bye, 2);

            $this->makeFixture($C, $E, 3);
            $this->makeFixture($A, $D, 3);
            $this->makeFixture($B, $bye, 3);

            $this->makeFixture($A, $C, 4);
            $this->makeFixture($B, $E, 4);
            $this->makeFixture($D, $bye, 4);

            $this->makeFixture($A, $E, 5);
            $this->makeFixture($B, $D, 5);
            $this->makeFixture($C, $bye, 5);
         }

        return redirect()->route('fixtures.index');
    }

    private function makeFixture($A, $B, $round) {
        $fixture = new Fixture();
        $fixture->round = $round;
        $fixture->teamOne()->associate($A);
        $fixture->teamTwo()->associate($B);
        $fixture->save();
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
            'team_id' => 'required'
        ]);

        Player::create($request->all());

        return redirect()->route('players.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fixture  $fixture
     * @return \Illuminate\Http\Response
     */
    public function show(Fixture $fixture)
    {
        $t1p1 = Player::find($fixture->t1p1_id)->name;
        $t2p1 = Player::find($fixture->t2p1_id)->name;
        $t1_total = $fixture->team_one_score
            + $fixture->t1p1_score
            + $fixture->t1p2_score
            + $fixture->t1p3_score
            + $fixture->t1p4_score
            + $fixture->t1p1_negs
            + $fixture->t1p2_negs
            + $fixture->t1p3_negs
            + $fixture->t1p4_negs;
        $t2_total = $fixture->team_two_score
            + $fixture->t2p1_score
            + $fixture->t2p2_score
            + $fixture->t2p3_score
            + $fixture->t2p4_score
            + $fixture->t2p1_negs
            + $fixture->t2p2_negs
            + $fixture->t2p3_negs
            + $fixture->t2p4_negs;
        return view('fixtures.show', compact('fixture', 't1p1', 't2p1',
        't1_total', 't2_total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Fixture $fixture)
    {
        $team1 = $fixture->teamOne()->first();
        $team2 = $fixture->teamTwo()->first();
        $fid = $fixture->getId();

        return view('fixtures.edit', compact('team1', 'team2', 'fid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $player->update($request->all());

        return redirect()->route('players.index')
            ->with('success', 'Player updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')
            ->with('success', 'Team deleted successfully');
    }
}
