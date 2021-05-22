<?php

namespace Tests\Feature;

use App\Models\Topic;
use App\Models\Tutorial;
use App\Models\TutorialView;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function homeScreenHasTopicNames()
    {
        $topic = Topic::factory()->create();
        $response = $this->get('/')->assertStatus(200)->assertSee($topic->name);
    }

    /** @test */
    public function topicScreenShowListOfTutorials()
    {
        $topic = Topic::factory()->create();
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$topic->id]);
        $tutorial_2 = Tutorial::factory()->create(['topic_id'=>$topic->id]);

        $this->get(route('home.tutorials.default', $topic->name))
            ->assertStatus(200)
            ->assertSee($tutorial_1->name)
            ->assertSee($tutorial_2->name);
    }

    /** @test */
    public function when_user_visit_topic_has_no_tutorials_it_will_give_him_will_be_added_soon()
    {
        $topic = Topic::factory()->create();

        $this->get(route('home.tutorials.default', $topic->name))
            ->assertStatus(200)
            ->assertSee('will be added soon');
    }

    /** @test */
    public function tutorialScreenShowItsNameAndDescription()
    {
        $topic = Topic::factory()->create();
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$topic->id]);

        $this->get(route('home.tutorials.specific', [$topic->name,$tutorial_1->name]))
            ->assertStatus(200)
            ->assertSee($tutorial_1->name)
            ->assertSee($tutorial_1->description);
    }

    /** @test */
    public function when_user_visit_tutorial_it_will_be_recorded_in_db()
    {
        $topic = Topic::factory()->create();
        $tutorial = Tutorial::factory()->create(['topic_id'=>$topic->id]);
        $this->get(route('home.tutorials.specific', [$topic->name,$tutorial->name]));
        $this->assertEquals(1, TutorialView::count());
    }
}
