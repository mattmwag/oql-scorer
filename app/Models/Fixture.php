<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'round', 'team_one_id', 'team_two_id', 'team_one_score', 'team_two_score',
        't1p1_id', 't1p2_id', 't1p3_id', 't1p4_id', 't2p1_id', 't2p2_id', 't2p3_id', 't2p4_id',
        't1p1_score', 't1p1_negs', 't1p2_score', 't1p2_negs', 't1p3_score', 't1p3_negs', 't1p4_score', 't1p4_negs',
        't2p1_score', 't2p1_negs', 't2p2_score', 't2p2_negs', 't2p3_score', 't2p3_negs', 't2p4_score', 't2p4_negs',
    ];

    public function getId()
    {
        return $this->id;
    }

    public function teamOne() {
        return $this->belongsTo(Team::class);
    }

    public function teamTwo() {
        return $this->belongsTo(Team::class);
    }
}
