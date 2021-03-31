<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'user_id' => User::factory(),  //relates user_id με το User model
            'title' => $this->faker->sentence(7,11),
            'post_image' => $this->faker->imageUrl('900','300'),
            'body' => $this->faker->paragraphs(rand(10, 15), true),
        ];
    }
}
