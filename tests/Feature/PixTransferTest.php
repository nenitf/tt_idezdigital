<?php

namespace Tests\Feature;

use App\Models\PixTransfer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PixTransferTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_should_return_a_list_of_pix_transfers()
    {
        $user = User::factory()->create();

        PixTransfer::factory()
            ->count(20)
            ->create();

        $this
            ->actingAs($user)
            ->get('/api/pix-transfers')
            ->assertSuccessful()
            ->assertJsonCount(20);
    }

    public function test_it_should_return_a_pix_transfer()
    {
        $user = User::factory()->create();

        $pixTransfer = PixTransfer::factory()
            ->create([
                'user_id' => $user->id
            ]);

        $this
            ->actingAs($user)
            ->get("/api/pix-transfers/{$pixTransfer->id}")
            ->assertSuccessful()
            ->assertJson([
                'id' => $pixTransfer->id,
                'user_id' => $user->id,
                'amount' => $pixTransfer->amount,
                'key' => $pixTransfer->key,
            ]);
    }

    public function test_can_create_pix_transfer()
    {
        $user = User::factory()->create();

        $key = $this->faker->text();
        $amount = $this->faker->randomFloat(2, 1, 100);
        $user_id = $user->id;

        $this
            ->actingAs($user)
            ->post("/api/pix-transfers", [
                'key' => $key,
                'amount' => $amount,
                'user_id' => $user_id,
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('pix-transfers', [
            'key' => $key,
            'amount' => $amount,
            'user_id' => $user_id,
        ]);
    }

    public function test_can_update_pix_transfer()
    {
        $user = User::factory()->create();
        $pixTransfer = PixTransfer::factory()
            ->create([
                'user_id' => $user->id
            ]);

        $key = $this->faker->text();
        $amount = $this->faker->randomFloat(2, 1, 100);
        $user_id = $user->id;

        $this
            ->actingAs($user)
            ->put("/api/pix-transfers/{$pixTransfer->id}", [
                'key' => $key,
                'amount' => $amount,
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('pix-transfers', [
            'key' => $key,
            'amount' => $amount,
            'user_id' => $user_id,
        ]);
    }

    public function test_can_delete_pix_transfer()
    {
        $user = User::factory()->create();

        $pixTransfer = PixTransfer::factory()
            ->create([
                'user_id' => $user->id
            ]);

        $this
            ->actingAs($user)
            ->delete("/api/pix-transfers/{$pixTransfer->id}")
            ->assertSuccessful();

        $this->assertDatabaseMissing('pix_transfers', [
            'id' => $pixTransfer->id,
        ]);
    }
}
