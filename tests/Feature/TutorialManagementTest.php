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

    /** @test */
    public function user_can_visit_create_tutorial()
    {
        $this->get(route('admin.tutorials.create', $this->topic->id))->assertSee('button');
    }

    /** @test */
    public function user_can_store_tutorial()
    {
        $this->post(route('admin.tutorials.store', $this->topic->id), [
            'name'=>'hello',
            'description'=>'description'
        ]);

        $this->assertEquals('hello', Tutorial::first()->name);
    }

    /** @test */
    public function user_can_visit_edit_screen()
    {
        $tutorial = Tutorial::factory()->create();

        $this->get(route('admin.tutorials.edit', [$this->topic->id,$tutorial->id]))
            ->assertSee('button');
    }

    /** @test */
    public function user_can_update_tutorial()
    {
        $tutorial = Tutorial::factory()->create(['topic_id'=>$this->topic->id]);

        $this->put(route('admin.tutorials.update', [$this->topic->id,$tutorial->id]), [
            'name'=>'hello',
            'description'=>'description'
        ]);

        $tutorial->refresh();
        $this->assertEquals('hello', $tutorial->name);
    }

    /** @test */
    public function user_can_soft_delete_tutorial()
    {
        $tutorial = Tutorial::factory()->create(['topic_id'=>$this->topic->id]);
        $this->delete(route('admin.tutorials.destroy',[$this->topic->id,$tutorial->id]));
        $tutorial->refresh();
        $this->assertTrue($tutorial->trashed());
    }

    /** @test */
    public function deleted_tutorials_can_be_restored()
    {
        $tutorial = Tutorial::factory()->create(['topic_id'=>$this->topic->id]);
        $tutorial->delete();
        $this->put(route('admin.tutorials.trashed.restore',$tutorial->id));
        $tutorial->refresh();
        $this->assertFalse($tutorial->trashed());
    }
}
