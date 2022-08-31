<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_activities_index()
    {
        $response = $this
            ->withToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC93b3Jrb3V0LmxvY1wvYXBpXC92MVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2NTc1NzE2ODcsImV4cCI6MTY1NzU3NTI4NywibmJmIjoxNjU3NTcxNjg3LCJqdGkiOiJWMU9aVzZGTUIwaTcwWHJzIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.7AI1l52D5ZNmJMg0pBW9nf9MxMdLYI02LQVaB1VeTag')
            ->get('/api/v1/activities');

        $response->assertOk();

        $response->assertJsonPath('data.0.id', 42);
    }
}
