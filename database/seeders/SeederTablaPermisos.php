<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;


class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos=[
            //tabla usuarios
            'Ver-usuarios',
            'Crear-usuarios',
            'Editar-usuarios',
            'Borrar-usuarios',

            //tabla roles
            'Ver-rol',
            'Crear-rol',
            'Editar-rol',
            'Borrar-rol',

            //tabla inventario
            'Ver-inventario',
            'Crear-inventario',
            'Editar-inventario',
            'Borrar-inventario',
            
        ];
        foreach ($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}