<?php

namespace Tests\Unit;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_can_be_create(): void
    {
        Role::factory()->create();
        $this->assertDatabaseCount('roles', 1);
    }

}
