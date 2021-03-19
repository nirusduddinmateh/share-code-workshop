<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usersIDs = DB::table('users')->pluck('id');

        return [
            'author_id' => $this->faker->randomElement($usersIDs),
            'title' => $this->faker->realText(50),
            'description' => $this->faker->text,
            'img' => null
        ];
    }
}
