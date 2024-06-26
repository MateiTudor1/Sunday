<?php

namespace Database\Seeders;

use App\Models\Today;
use App\Models\Upcoming;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TodaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=\Faker\Factory::create();

        for($i=0;$i<5;$i++)
        {
            Today::create([
                'completed'=>false,
                'title'=>$faker->sentence($nbWords=4,$variableWords=false),
                'approved'=>false,
                'taskId'=>Str::random(10)
            ]);
        }
    }
}
