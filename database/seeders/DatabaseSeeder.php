<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $admin = User::factory()->has(Course::factory()->count(2), 'courses')->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        $users = User::factory()->count(2)->create();

        $coursesByAdmin = $admin->courses;

        foreach($users as $user) {
            $user->enrolledCourses()->toggle($coursesByAdmin->pluck('id'));
        }
    }
}
