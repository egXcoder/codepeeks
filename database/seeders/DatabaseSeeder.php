<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('123')
        ]);
        $this->call(TopicSeeder::class);
        $this->call(TutorialSeeder::class);
        $this->call(TutorialViewSeeder::class);
    }
}
