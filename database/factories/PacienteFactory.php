<?php

namespace Database\Factories;
use App\Models\Paciente;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    protected $model = Paciente::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_identificacion' => $this->faker->randomElement(['V','E']),
            'identificacion' => $this->faker->numerify('########'),
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'correo_electronico' => $this->faker->safeEmail,
            'f_nacimiento' => $this->faker->date('Y-m-d', max:'2000-01-01'),
            'edad' => Str::random(2),
            'direccion' => $this->faker->address,
            'telefono' => Str::random(10),

        ];
    }
}
