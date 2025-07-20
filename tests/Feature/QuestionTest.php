<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;


class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_question()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cat1 = Category::create(['name' => 'Teszt kategória 1']);
        $cat2 = Category::create(['name' => 'Teszt kategória 2']);

        $response = $this->post('/questions', [
            'questionTitle' => 'Teszt kérdés',
            'questionBody' => 'Teszt leírás',
            'categories' => [$cat1->id, $cat2->id]
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('questions', [
            'questionTitle' => 'Teszt kérdés',
            'authorId' => $user->id
        ]);
    }
}
