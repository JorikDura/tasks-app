<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Complexity;
use App\Enums\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'status' => fake()->randomElement(
                [
                    Status::BrainStorming,
                    Status::InWork,
                    Status::Planned,
                    Status::Done,
                    Status::Canceled
                ]
            ),
            'complexity' => fake()->randomElement([
                Complexity::Easy,
                Complexity::Medium,
                Complexity::Hard,
                Complexity::UltraHard
            ]),
            'urgency' => $this->faker->numberBetween(1, 10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deadline_at' => Carbon::now(),
            'creator_id' => User::factory(),
            'performer_id' => User::factory(),
        ];
    }
}
