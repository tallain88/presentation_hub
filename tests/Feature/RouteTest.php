<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RouteTest extends TestCase
{
    /*@Test Index*/
    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /*@Test Unauthorized Home*/
    public function testHomeUnauthorized()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login'); //should be unauthorized and redirected to login
    }
    
    /*@Test Authorized Home*/
    public function testHomeAuthorized()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
    }
}
