<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_checkNewsCreation()
    {
        $response = $this->post('/api/v1/news/create', [
            'title' => 'S',
            'description' => 'asd',
            'text' => 'asd'
        ]);
        $response->assertStatus(201);
    }

    public function test_checkNewsCreationValidation()
    {
        $response = $this->post('/api/v1/news/create', [
            'title' => 'S',
        ], [
            'accept' => 'application/json'
        ]);
        $response->assertStatus(422);
    }
}
