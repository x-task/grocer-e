<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //DB::table('users')->truncate();
        //DB::table('posts')->truncate();

        //User::factory(10)->create();
        //Post::factory(10)->create();


     User::factory(100)->create()->each(function($user){ //Δημιουργούμε n users με αντιστοιχα 10 posts
        $user->posts()->save(Post::factory()->make());  // User::factory(n)->create()->each(function($user)
     });
    }
}
