<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++)
        Team::factory()
            ->count(5)
            ->hasPlayers(5)
            ->make([
                'group' => $i
            ]);

        $bye = new Team();
        $bye->id = 999;
        $bye->name = 'Bye';
        $bye->group = 999;
        $bye->save();
    }
}
