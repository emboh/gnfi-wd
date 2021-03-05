<?php

namespace Database\Factories;

use App\Models\Reward;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RewardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reward::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'creator_id' => User::role(Role::ADMIN)->inRandomOrder()->first()->id,
            'name' => $this->faker->words(3, true),
            'points' => $this->faker->numberBetween(1, 20),
        ];
    }
}
