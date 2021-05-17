<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\Tutorial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tutorial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word(2),
            'description'=>$this->faker->paragraph(20),
            'color'=>$this->faker->hexColor,
            'order'=>rand(0, 1000),
            'topic_id'=>Topic::inRandomOrder()->first()->id,
        ];
    }
}
