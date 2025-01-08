<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_user_has_role(): void
    {
        // Create a role
        $role = Role::factory()->create(['id' => 1, 'name' => 'admin']); // Ensure role has an ID

        // Create a user with that role
        $user = User::factory()->create([
            'role_id' => $role->id, // Assuming `role_id` exists on the `users` table
        ]);

        // Assert that the user has the correct role
        $this->assertTrue($user->hasRole($user, [1])); // Check against the role ID
    }
}
