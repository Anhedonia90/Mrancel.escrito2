<?php

namespace Tests\Feature;

use App\Models\Persona;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonaTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function test_alta_sin_datos()
    {
        $response = $this->post('/api/alta');

        $response->assertStatus(400);
    }

    public function test_alta_insertando_datos()
    {
        $personaInfo = [
            "nombre" => $this->faker->name,
            "apellido" => $this->faker->lastName,
            "telefono" => $this->faker->phoneNumber,
        ];

        $response = $this->post('/api/alta', $personaInfo);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'nombre',
            'apellido',
            'telefono'
        ]);
        $this->assertDatabaseHas('personas', $personaInfo);
    }

    public function test_baja_sin_existencia()
    {
        $response = $this->get("/api/baja");
        $response->assertStatus(404);
    }
    public function test_baja_existente()
    {
        $personaInfo = [
            "nombre" => $this->faker->name,
            "apellido" => $this->faker->lastName,
            "telefono" => $this->faker->phoneNumber,
        ];

        $persona = Persona::create($personaInfo);

        $response = $this->delete("/api/baja/$persona[id]");

        $response->assertStatus(200);
        $response->assertJsonFragment(["response" => "La persona con el ID $persona[id] ha sido dado de baja"]);
    }
    public function test_listar_personas()
    {
        $personaInfo = [
            "nombre" => $this->faker->name,
            "apellido" => $this->faker->lastName,
            "telefono" => $this->faker->phoneNumber,
        ];

        Persona::create($personaInfo);
        Persona::create($personaInfo);

        $response = $this->get("/api/listar");

        $response->assertStatus(200);
    }

    public  function test_buscar_persona()
    {

        $personaInfo = [
            "nombre" => $this->faker->name,
            "apellido" => $this->faker->lastName,
            "telefono" => $this->faker->phoneNumber,
        ];

        $persona = Persona::create($personaInfo);

        $response = $this->get("/api/buscar/$persona[id]");
        $response->assertStatus(200);
        $response->assertJsonFragment($personaInfo);
    }
    public  function test_buscar_persona_noexiste()
    {
        $response = $this->get("/api/buscar/99999999999");
        $response->assertStatus(404);
        
    }

}
