<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AdminAccessTest extends TestCase
{
    public function test_non_admin_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('admin.projects.index'))
            ->assertStatus(403);
    }

    public function test_admin_can_access_admin_routes(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get('/admin/projects')
            ->assertStatus(200);
    }
}
