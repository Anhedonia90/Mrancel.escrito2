<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_alta_sin_datos()
    {
        $response = $this->post('/api/alta');

        $response->assertStatus(400);
    }

    public function test_alta_insertando_datos ()
    {
        $response = $this->post('/api/alta',[
            "nombre" => "Matias",
            "apellido" => "Rancel",
            "telefono" => "123123123",
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'nombre',
            'apellido',
            'telefono'
            ]);
        $this->assertDatabaseHas('persona',[
            "nombre" => "Matias",
            "apellido" => "Rancel",
            "telefono" => "123123",
        ]);
    }
}