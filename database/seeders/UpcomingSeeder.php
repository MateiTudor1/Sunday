<?php

namespace Database\Seeders;

use App\Models\Upcoming;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpcomingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=\Faker\Factory::create();

        for($i=0;$i<5;$i++)
        {
            Upcoming::create([
                'completed'=>false,
                'title'=>$faker->sentence($nbWords=4,$variableWords=false),
                'approved'=>false,
                'waiting'=>true,
                'taskId'=>Str::random(10)
            ]);
        }
    }
}
