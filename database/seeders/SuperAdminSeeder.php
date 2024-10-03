<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$usuario = User::create([
        //    'name'=> 'pablo',
        //    'email'=> 'admin@gmail.com',
        //    'password'=> bcrypt('admin')
        //]);

        $rol = Role::create(['name'=>'Administrador']);

        //$permisos = Permission::pluck('id', 'id')->all();

        //$rol->syncPermissions($permisos);

        //$usuario->assignRole([$rol->id]);
    }
}
