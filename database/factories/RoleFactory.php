<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['admin', 'enseignant', 'etudiant']),
            'description' => function (array $attributes) {
                return match($attributes['name']) {
                    'admin' => 'Administrateur du système',
                    'enseignant' => 'Enseignant qui peut créer et gérer des cours',
                    'etudiant' => 'Étudiant qui peut suivre des cours',
                    default => 'Rôle par défaut'
                };
            },
        ];
    }
} 