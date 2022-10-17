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
        Team::factory()
            ->count(45)
            ->hasPlayers(5)
            ->create();

        Team::query()
            ->update([
                'group' => DB::raw("(`id`-1)/5+1")
            ]);

        $bye = new Team();
        $bye->id = 9999;
        $bye->name = 'Bye';
        $bye->group = 9999;
        $bye->save();
    }
}
