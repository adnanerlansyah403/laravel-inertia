<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_can_view_products(): void
    {
        // Membuat role baru
        $role = Role::factory()->create(['id' => 1, 'name' => 'admin']);

        // Membuat user baru
        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        // Login sebagai user
        $this->actingAs($user);

        // Mengunjungi halaman products
        $response = $this->get('/products');

        // Memastikan user memiliki akses ke halaman dan komponen yang di load nya sesuai sekaligus juga dapat melihat data products nya
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) =>
            $page->component('Products/Index')
            ->has('products')
        );
    }
}
