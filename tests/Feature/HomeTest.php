<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function homeScreenHasTopicNames()
    {
        //given we go to home screen 
        $response = $this->get('/');

        //assert see topic name
        $response->assertStatus(200);
    }
}
