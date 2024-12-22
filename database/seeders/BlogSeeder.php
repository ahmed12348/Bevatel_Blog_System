<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
        {
            $user = User::first(); // Assuming a user already exists
            Blog::create([
                'title' => 'My First Blog',
                'description' => 'This is the description of my first blog.',
                'user_id' => $user->id,
            ]);
        }
    
}
