<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Presentation;

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
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
    }

    /*@Test Authorized Presentation Index*/
    public function testPresentationIndexAuthorized()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/presentation');

        $response->assertStatus(200);
    }

    /*@Test Unauthorized Presentation Index*/
    public function testPresentationIndexUnauthorized()
    {
        $response = $this->get('/presentation');

        $response->assertRedirect('/login');
    }
    // /*@Test Presentation Link*/
    public function testPresentationLink()
    {
        $presentation = Presentation::factory()->make();

        $response = $this->get("/presentation/$presentation->link");

        $response->assertStatus(200);
    }

    /*@Test Store Presentation Unauthorized*/
    public function testStorePresentationUnauthorized()
    {
        $presentation = Presentation::factory()->make();

        $response = $this->post('/presentation');

        $response->assertRedirect('/login');
    }

    /*@Test Store Presentation Authorized*/
    public function testStorePresentationAuthorized()
    {
        $user = User::factory()->create();

        $presentation = Presentation::factory()->make();

        $response = $this->actingAs($user)->post('/presentation', $presentation->toArray());

        $response->assertStatus(200);
    }
}
