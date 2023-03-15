<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $categories = Category::all();
        // $users = User::all();

        // foreach ($categories as $category) {
        //     foreach ($users as $user) {
        //         Book::factory()->count(5)->create([
        //             'category_id' => $category->id,
        //             'user_id' => $user->id,
        //         ]);
        //     }
        // }

        Book::factory()->count(25)->create();

    }
}
