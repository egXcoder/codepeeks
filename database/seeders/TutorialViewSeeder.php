<?php

namespace Database\Seeders;

use App\Models\Tutorial;
use App\Models\TutorialView;
use Illuminate\Database\Seeder;

class TutorialViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Tutorial::all() as $tutorial){
            TutorialView::factory(10)->create(['tutorial_id'=>$tutorial->id]);
        }
    }
}
