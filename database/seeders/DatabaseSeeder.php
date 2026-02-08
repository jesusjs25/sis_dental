<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Consultorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       // User::factory()->create([
          //  'name' => 'Test User',
         //   'email' => 'test@example.com',
        //]);

        $this->call([RoleSeeder::class,]);
        
        User::create([

            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),

        ])->assignRole('admin');


        User::create([

            'name' => 'Secretaria',
            'email' => 'secretaria@gmail.com',
            'password' => Hash::make('12345678'),

        ])->assignRole('admin');


        User::create([

            'name' => 'Doctor1',
            'email' => 'doctor1@gmail.com',
            'password' => Hash::make('12345678'),

        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor1',
            'apellidos' => 'Hands',
            'telefono' => '1234567',
            'licencia_medica' => '101010',
            'especialidad' => 'PEDIATRA',
            'user_id' =>'3',
        ]);

        User::create([

            'name' => 'Doctor2',
            'email' => 'doctor2@gmail.com',
            'password' => Hash::make('12345678'),

        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor2',
            'apellidos' => 'CUFFS',
            'telefono' => '1234567',
            'licencia_medica' => '202020',
            'especialidad' => 'ODONTOLOGIA',
            'user_id' =>'4',
        ]);

        User::create([

            'name' => 'Docto3',
            'email' => 'doctor3@gmail.com',
            'password' => Hash::make('12345678'),

        ])->assignRole('doctor');

         Doctor::create([
            'nombres' => 'Doctor',
            'apellidos' => 'INMATE',
            'telefono' => '1234567',
            'licencia_medica' => '303030',
            'especialidad' => 'TERAPIA',
            'user_id' =>'5',
        ]);


        Consultorio::create([

            'nombre' => 'ODONTOLOGIA',
            'ubicacion' => 'PISO BAJO',
            'capacidad' => '10',
            'telefono' => '12345678',
            'especialidad' => 'ODONTOLOGIA',
            'estado' => 'ACTIVO',

        ]);

        Consultorio::create([

            'nombre' => 'EXTRACION',
            'ubicacion' => 'PISO 1',
            'capacidad' => '5',
            'telefono' => '12345678',
            'especialidad' => 'EXTRACIION',
            'estado' => 'ACTIVO',

        ]);

        Consultorio::create([

            'nombre' => 'TERAPIA',
            'ubicacion' => 'PISO 2',
            'capacidad' => '30',
            'telefono' => '12345678',
            'especialidad' => 'TERAPIA',
            'estado' => 'ACTIVO',

        ]);

        

        User::create([

            'name' => 'Paciente1',
            'email' => 'paciente1@gmail.com',
            'password' => Hash::make('12345678'),

        ])->assignRole('paciente');

        
       $this->call([PacienteSeeder::class,]);

       
    }
}
