<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nim' => '1710',
            'fakultas' => $this->faker->randomElement(['FEB', 'FHK', 'FIK', 'FKD', 'FKS', 'FSP', 'FTK']),
            'thn_lulus' => '2021',
            'tanggal_lahir' => $this->faker->date('Y-m-d', '1998-12-31'),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            $number = 0;
            switch (Str::upper($user->fakultas)) {
                case 'FEB':
                    $number = 111;
                    break;
                case 'FHK':
                    $number = 611;
                    break;
                case 'FIK':
                    $number = 511;
                    break;
                case 'FKD':
                    $number = 211;
                    break;
                case 'FKS':
                    $number = 711;
                    break;
                case 'FSP':
                    $number = 411;
                    break;
                case 'FTK':
                    $number = 311;
                    break;
                default:
                    # code...
                    break;
            }
            $nim = $user->nim . $number;

            $user->nim = $nim;
        })->afterCreating(function (User $user) {
            $user->nim = $user->nim. sprintf("%03s", $user->id);
            $user->save();
        });
    }
}
