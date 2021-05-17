<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Topic::all() as $topic){
            Tutorial::factory(20)->create(['topic_id'=>$topic->id]);
        }
    }
}
