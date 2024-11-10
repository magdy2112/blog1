<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create fake users
        $users = [];
        foreach (range(1, 10) as $index) {
            $users[] = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Use bcrypt to hash the password
                'email_verified_at' => now(), // Set email_verified_at to the current timestamp
            ]);
        }

        // Create fake posts for each user
        foreach ($users as $user) {
            foreach (range(1, 3) as $index) { // Each user has 1 to 3 posts
                $post = Post::create([
                    'user_id' => $user->id,
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'language' => $faker->randomElement(['ar', 'en']),
                ]);

                // Create fake comments for each post
                foreach (range(1, 5) as $index) { // Each post has 1 to 5 comments
                    $comment = Comment::create([
                        'post_id' => $post->id,
                        'user_id' => $users[array_rand($users)]->id, // Random user for comment
                        'content' => $faker->text,
                    ]);

                    // Create fake replies for each comment
                    foreach (range(1, 2) as $index) { // Each comment has 1 to 2 replies
                        Reply::create([
                            'user_id' => $users[array_rand($users)]->id, // Random user for reply
                            'comment_id' => $comment->id,
                            'content' => $faker->sentence,
                        ]);
                    }
                }
            }
        }
    }
}





