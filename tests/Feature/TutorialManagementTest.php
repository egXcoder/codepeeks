<?php

namespace Tests\Feature;

use App\Models\Topic;
use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TutorialManagementTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $topic;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->be($this->user);

        $this->topic = Topic::factory()->create();
    }

    /** @test */
    public function user_can_visit_tutorials_list_of_a_topic()
    {
        $tutorial = Tutorial::factory()->create(['topic_id'=>$this->topic->id]);

        $response = $this->get(route('admin.tutorials.index', $this->topic->id));
        $response->assertStatus(200);
        $response->assertSee($tutorial->name);
    }

    /** @test */
    public function user_can_up_topic_order()
    {
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>1]);
        $tutorial_2 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>2]);

        $this->post(route('admin.tutorials.up', $tutorial_2->id));

        $tutorial_2->refresh();
        $this->assertEquals(1, $tutorial_2->order);
    }

    /** @test */
    public function user_cant_up_topic_which_is_the_first_order()
    {
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>1]);
        $tutorial_2 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>2]);

        $this->post(route('admin.tutorials.up', $tutorial_1->id))->assertSessionHasErrors();
    }

    /** @test */
    public function user_can_down_topic_order()
    {
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>1]);
        $tutorial_2 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>2]);

        $this->post(route('admin.tutorials.down', $tutorial_1->id));

        $tutorial_1->refresh();
        $this->assertEquals(2, $tutorial_1->order);
    }

    /** @test */
    public function user_cant_down_topic_which_is_the_first_order()
    {
        $tutorial_1 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>1]);
        $tutorial_2 = Tutorial::factory()->create(['topic_id'=>$this->topic->id,'order'=>2]);

        $this->post(route('admin.tutorials.down', $tutorial_2->id))->assertSessionHasErrors();
    }
}
