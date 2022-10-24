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

    public $count = 0;
    public $phase = "TOSSUP 1";
    public $history = [];

    public function increment($team, $player, $points)
    {
        $incCount = true;
        $method = $team == 1 ? "t1" : "t2";
        if ($player == 0)  {
            $method .= "bonuses";
        } else {
            $method .= "p" . $player;
        }
        if ($points < 0) {
            $method .= "neg";
            $incCount = false;
        }
        $this->$method += $points;
        array_push($this->history, [$method, $points]);
        if ($incCount) { $this->count++; }

        switch ($this->count % 4) {
            case 0:
                $this->phase = "TOSSUP " . $this->count / 4 + 1;
                break;
            default:
                $this->phase = "TOSSUP " . floor($this->count / 4 + 1) . " BONUS " . $this->count % 4;
        }
    }

    public function next()
    {
        array_push($this->history, ["t1bonuses", 0]);
        $this->count++;
    }

    public function undo()
    {
        if (empty($this->history)) {
            return;
        }

        $last = array_pop($this->history);
        [$method, $points] = $last;
        $this->$method -= $points;
        $this->count--;
    }

    public function save()
    {
        $t1total =  $this->t1bonuses + $this->t1p1 + $this->t1p2 + $this->t1p3 + $this->t1p4 +
            $this->t1p1neg + $this->t1p2neg + $this->t1p3neg + $this->t1p4neg;
        $t2total =  $this->t2bonuses + $this->t2p1 + $this->t2p2 + $this->t2p3 + $this->t2p4 +
            $this->t2p1neg + $this->t2p2neg + $this->t2p3neg + $this->t2p4neg;
        if ($t1total == $t2total) {
            $t1result = $t2result = 2;
        }
        if ($t1total > $t2total) {
            $t1result = 4;
            $t2result = $t1total - $t2total <= 50 ? 1 : 0;
        }
        if ($t2total > $t1total) {
            $t2result = 4;
            $t1result = $t2total - $t1total <= 50 ? 1 : 0;
        }

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
        $fixture->history = serialize($this->history);
        $fixture->t1result = $t1result;
        $fixture->t2result = $t2result;
        $fixture->save();

        return redirect()->route('fixtures.index')
            ->with('success', 'Result updated successfully');
    }

    public function render()
    {
        return view('livewire.scorer');
    }
}
