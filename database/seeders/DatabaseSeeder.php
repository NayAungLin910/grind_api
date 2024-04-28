<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Certificate;
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

        // Create an admin acc
        $admin = User::factory()->has(Course::factory()->count(2), 'courses')->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        // Create two normal users accounts
        $users = User::factory()->count(2)->create();

        $coursesByAdmin = $admin->courses;

        foreach($users as $user) {
            // enroll the users into the courses created by admin
            $user->enrolledCourses()->toggle($coursesByAdmin->pluck('id'));
        }

        $certificateCollections = collect();

        foreach($coursesByAdmin->pluck('id') as $courseId) {
            // create certificate for each course
            $certificate = Certificate::factory()->create([
                'courseId' => $courseId,
            ]);
            $certificateCollections->push($certificate);
        }

        // Get the courses lazy loaded with certificate
        $coursesByAdmin = Course::whereIn('id', $admin->courses->pluck('id'))->with('certificate')->get();

        foreach($admin->courses as $course) {
            $course = $course->with('certificate')->get();

            $coursesByAdmin->push($course);
        }

        foreach($users as $user) {
            // completing a course the user is enrolling
            $user->enrolledCourses()->updateExistingPivot($coursesByAdmin[0]->id, [
                'status' => 'completed',
            ]);

            // Granting the user the certificate of the completed course
            $user->certificates()->attach($coursesByAdmin[0]->certificate->id);
        }
    }
}
