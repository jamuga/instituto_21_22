<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Centro;
use Laravel\Sanctum\Sanctum;

class CentroCoordinadoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        Sanctum::actingAs(
            User::factory()
                ->has(
                    Centro::factory(),
                    'centroCoordinado'
                )
                ->create()
        );

        $response = $this->get('/api/miCentro');

        $response->assertStatus(200)
        ->assertJsonStructure(['data' => ['codigo', 'nombre', 'web']])
        ->assertJsonCount(1);
    }
}
