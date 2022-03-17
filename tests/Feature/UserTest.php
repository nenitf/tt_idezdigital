<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_should_return_a_list_of_users()
    {
        $user = User::factory()->create();

        $users = User::factory()->count(19)->create();

        $this
            ->actingAs($user)
            ->get('/api/users')
            ->assertSuccessful()
            ->assertJsonCount(20);
    }

    public function test_it_should_return_a_user()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get("/api/users/{$user->id}")
            ->assertSuccessful();
    }

    public function test_can_create_user()
    {
        $name = $this->faker->name();
        $email = $this->faker->email;
        $password = $this->faker->text();

        $this
            ->post("/api/users", [
                'name' => $name,
                'email' => $email,
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('pix-transfers', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();

        $name = $this->faker->name();
        $email = $this->faker->email;

        $this
            ->actingAs($user)
            ->put("/api/users/{$user->id}", [
                'name' => $name,
                'email' => $email,
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('pix-transfers', [
            'name' => $name,
            'email' => $email,
        ]);
    }

    public function test_can_delete_user()
    {
        $user = User::factory()->create();

        $userToDelete = User::factory()
            ->create();

        $this
            ->actingAs($user)
            ->delete("/api/users/{$userToDelete->id}")
            ->assertSuccessful();

        $this->assertDatabaseMissing('pix_transfers', [
            'id' => $userToDelete->id,
        ]);
    }
}
