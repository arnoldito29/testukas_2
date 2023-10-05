<?php

namespace Database\Factories;

use App\Enums\MimeTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cases = collect(MimeTypeEnum::cases())->pluck('value');

        return [
            'name' => fake()->name(),
            'mime_type' => fake()->randomElement($cases),
        ];
    }
}
