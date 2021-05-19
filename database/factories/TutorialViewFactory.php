<?php

namespace Database\Factories;

use App\Models\Tutorial;
use App\Models\TutorialView;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorialViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TutorialView::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tutorial_id'=>Tutorial::inRandomOrder()->first()->id,
            'created_at'=>$this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
