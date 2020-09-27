<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsControllerTest extends TestCase
{

  public function testIndex(){
    $response = $this->get(route('posts.index'));

    $response->assertRedirect('login');
  }

  public function testGuestCreate(){
    $response = $this->get(route('posts.new'));

    $response->assertRedirect('login');
  }

  public function testAuthCreate(){
    //Arrange(準備)
    $user = factory(User::class)->create();

    //Act(実行)
    $response = $this->actingAs($user)
      ->get(route('posts.new'));

    //Assert(検証)
    $response->assertStatus(200)
      ->assertViewIs('post.create');

  }
}
