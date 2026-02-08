<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seeder para los roles y permisos admin, secretarias, pacientes, usuarios

        $admin = Role::create(['name'=>'admin']);
        $doctor = Role::create(['name'=>'doctor']);
        $paciente = Role::create(['name'=>'paciente']);
        $usuario = Role::create(['name'=>'usuario']);

        Permission::create(['name'=>'admin.index']);

        //rutas para el admin-usuario
        Permission::create(['name'=>'admin.usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.destroy'])->syncRoles([$admin]);

        //rutas para el admin-pacientes
        Permission::create(['name'=>'admin.pacientes.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.pacientes.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.pacientes.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.pacientes.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.pacientes.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.pacientes.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.pacientes.destroy'])->syncRoles([$admin]);

        //rutas para el admin-consultorios
        Permission::create(['name'=>'admin.consultorios.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.consultorios.destroy'])->syncRoles([$admin]);

        //rutas para el admin-doctores
        Permission::create(['name'=>'admin.doctores.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.doctores.destroy'])->syncRoles([$admin]);

        //rutas para el admin-horarios
        Permission::create(['name'=>'admin.horarios.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.horarios.create'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.horarios.store'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.horarios.show'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.horarios.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.horarios.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.horarios.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.horarios.destroy'])->syncRoles([$admin]);

        //ajax-muestra horarios
        Permission::create(['name'=>'admin.horarios.cargar_datos_consultorios'])->syncRoles([$admin]);
    }
}
