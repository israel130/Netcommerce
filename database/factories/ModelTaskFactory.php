<?php

namespace Database\Factories;

use App\Models\ModelTask;
use App\Models\User; 
use App\Models\ModelCompanies;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelTask::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => ModelCompanies::factory(),
            'user_id' => User::factory(), 
            'name' => $this->faker->sentence, 
            'description' => $this->faker->paragraph, 
            'is_completed' => $this->faker->boolean, 
            'start_at' => now(), 
            'expired_at' => $this->faker->dateTimeBetween('+1 days', '+7 days'),
        ];
    }
}