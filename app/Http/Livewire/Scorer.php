<?php

namespace App\Http\Livewire;

use App\Models\Fixture;
use Livewire\Component;

class Scorer extends Component
{
    public $fid;

    public $team1;
    public $team2;

    public $t1p1_id;
    public $t1p2_id;
    public $t1p3_id;
    public $t1p4_id;
    public $t2p1_id;
    public $t2p2_id;
    public $t2p3_id;
    public $t2p4_id;

    public $t1p1 = 0;
    public $t1p2 = 0;
    public $t1p3 = 0;
    public $t1p4 = 0;

    public $t2p1 = 0;
    public $t2p2 = 0;
    public $t2p3 = 0;
    public $t2p4 = 0;

    public $t1p1neg = 0;
    public $t1p2neg = 0;
    public $t1p3neg = 0;
    public $t1p4neg = 0;

    public $t2p1neg = 0;
    public $t2p2neg = 0;
    public $t2p3neg = 0;
    public $t2p4neg = 0;

    public $t1bonuses = 0;
    public $t2bonuses = 0;

    public function increment($team, $player, $points)
    {
        $method = $team == 1 ? "t1" : "t2";
        if ($player == 0)  {
            $method .= "bonuses";
        } else {
            $method .= "p" . $player;
        }
        if ($points < 0) {
            $method .= "neg";
        }
        $this->$method += $points;
    }

    public function save()
    {
        $fixture = Fixture::find($this->fid);
        $fixture->team_one_score = $this->t1bonuses;
        $fixture->team_two_score = $this->t2bonuses;
        $fixture->t1p1_id = $this->t1p1_id;
        $fixture->t1p2_id = $this->t1p2_id;
        $fixture->t1p3_id = $this->t1p3_id;
        $fixture->t1p4_id = $this->t1p4_id;
        $fixture->t2p1_id = $this->t2p1_id;
        $fixture->t2p2_id = $this->t2p2_id;
        $fixture->t2p3_id = $this->t2p3_id;
        $fixture->t2p4_id = $this->t2p4_id;
        $fixture->t1p1_score = $this->t1p1;
        $fixture->t1p2_score = $this->t1p2;
        $fixture->t1p3_score = $this->t1p3;
        $fixture->t1p4_score = $this->t1p4;
        $fixture->t2p1_score = $this->t2p1;
        $fixture->t2p2_score = $this->t2p2;
        $fixture->t2p3_score = $this->t2p3;
        $fixture->t2p4_score = $this->t2p4;
        $fixture->t1p1_negs = $this->t1p1neg;
        $fixture->t1p2_negs = $this->t1p2neg;
        $fixture->t1p3_negs = $this->t1p3neg;
        $fixture->t1p4_negs = $this->t1p4neg;
        $fixture->t2p1_negs = $this->t2p1neg;
        $fixture->t2p2_negs = $this->t2p2neg;
        $fixture->t2p3_negs = $this->t2p3neg;
        $fixture->t2p4_negs = $this->t2p4neg;
        $fixture->save();

        return redirect()->route('fixtures.index')
            ->with('success', 'Result updated successfully');
    }

    public function render()
    {
        return view('livewire.scorer');
    }
}
