<?php

namespace Tests\Feature;
//Librerias
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\TestResponse;
use App\Models\Categoria;


class InventarioTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_agregar_categoria()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        
        $response = $this->post('categorias', [
            'tipo' => 'Cable HDMI'
           
        ]);

        $response->assertRedirect('/categorias');
        $this->assertDatabaseHas('categorias', [
            'tipo' => 'Cable HDMI'
        ]);
    }

}