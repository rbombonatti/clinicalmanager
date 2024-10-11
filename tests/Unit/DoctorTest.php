<?php

namespace Tests\Unit;

use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    use RefreshDatabase;

    public function test_doctor_can_be_create(): void
    {
        Doctor::factory()->create();
        $this->assertDatabaseCount('doctors', 1);
    }

}
