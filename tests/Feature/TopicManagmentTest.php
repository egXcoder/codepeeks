<?php

namespace Tests\Feature;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TopicManagmentTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->be($this->user);
    }

    /** @test */
    public function user_can_view_all_topics()
    {
        $topic = Topic::factory()->create();

        $response = $this->get(route('admin.topics.index'));

        $response->assertSee($topic->name);
    }

    /** @test */
    public function user_can_change_the_order_of_topics_to_up()
    {
        $topic_1 = Topic::factory()->create(['order'=>1]);
        $topic_2 = Topic::factory()->create(['order'=>2]);

        $this->post(route('admin.topics.up', $topic_2->id));

        $topic_1->refresh();
        $topic_2->refresh();
        $this->assertEquals(1, $topic_2->order);
        $this->assertEquals(2, $topic_1->order);
    }

    /** @test */
    public function user_cant_up_topic_which_is_already_the_first()
    {
        $topic_1 = Topic::factory()->create(['order'=>1]);
        $topic_2 = Topic::factory()->create(['order'=>2]);

        $this->post(route('admin.topics.up', $topic_1->id))->assertSessionHasErrors();
    }
    
    /** @test */
    public function user_can_change_the_order_of_topics_to_down()
    {
        $topic_1 = Topic::factory()->create(['order'=>1]);
        $topic_2 = Topic::factory()->create(['order'=>2]);

        $this->post(route('admin.topics.down', $topic_1->id));

        $topic_1->refresh();
        $topic_2->refresh();
        $this->assertEquals(1, $topic_2->order);
        $this->assertEquals(2, $topic_1->order);
    }

    /** @test */
    public function user_cant_down_topic_which_is_already_the_last()
    {
        $topic_1 = Topic::factory()->create(['order'=>1]);
        $topic_2 = Topic::factory()->create(['order'=>2]);

        $this->post(route('admin.topics.down', $topic_2->id))->assertSessionHasErrors();
    }

    /** @test */
    public function user_can_visit_create_topic_screen()
    {
        $this->get(route('admin.topics.create'))->assertSee('button');
    }

    /** @test */
    public function user_can_store_topic()
    {
        $this->post(route('admin.topics.store'), [
            'name'=>'hello world',
            'description'=>'description',
            'image'=> UploadedFile::fake()->image('avatar.png')
        ]);

        $this->assertEquals('hello world', Topic::first()->name);
        $this->assertEquals('description', Topic::first()->description);

        unlink(public_path("/images/" .time() . ".png"));
    }

    /** @test */
    public function user_can_visit_edit_topic_screen()
    {
        $topic = Topic::factory()->create();
        $this->get(route('admin.topics.edit', $topic->id))->assertSee('button');
    }

    /** @test */
    public function user_can_update_topic()
    {
        $topic = Topic::factory()->create();

        $this->put(route('admin.topics.update', $topic->id), [
            'name'=>'hello',
            'description'=>'description',
        ]);
        
        $topic->refresh();
        $this->assertEquals('hello', $topic->name);
    }
}
