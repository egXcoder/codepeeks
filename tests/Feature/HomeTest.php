<?php

namespace Tests\Feature;

use App\Models\Topic;
use App\Models\Tutorial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function homeScreenHasTopicNames()
    {
        $topic = Topic::factory()->create();
        $response = $this->get('/')->assertSee($topic->name);
    }

    /** @test */
    public function topicScreenShowListOfTutorials()
    {
        $topic = Topic::factory()->create();
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$topic->id]);
        $tutorial_2 = Tutorial::factory()->create(['topic_id'=>$topic->id]);

        $this->get(route('home.tutorials', $topic->name))
            ->assertSee($tutorial_1->name)
            ->assertSee($tutorial_2->name);
    }

    /** @test */
    public function tutorialScreenShowItsNameAndDescription()
    {
        $topic = Topic::factory()->create();
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$topic->id]);

        $this->get(route('home.tutorials', [$topic->name,$tutorial_1->name]))
            ->assertSee($tutorial_1->name)
            ->assertSee($tutorial_1->description);
    }
}
