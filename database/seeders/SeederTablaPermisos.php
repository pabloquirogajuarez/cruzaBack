<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operacions sobre tabla users
            'ver-user',
            'crear-user',
            'editar-user',
            'borrar-user',


            //Operacions sobre tabla empresas
            'ver-empresa',
            'crear-empresa',
            'editar-empresa',
            'borrar-empresa',

            //Operaciones sobre vendedores
            'ver-vendedor',
            'crear-vendedor',
            'editar-vendedor',
            'borrar-vendedor',

            
            //Operaciones sobre socios
            'ver-socio',
            'crear-socio',
            'editar-socio',
            'borrar-socio'            
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
