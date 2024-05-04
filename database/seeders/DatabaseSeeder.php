<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Question;
use App\Models\Section;
use App\Models\Step;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
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
        // Create an admin acc
        $admin = User::factory()->has(Course::factory()->count(2), 'courses')->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        // Create sections and setps for each section
        $this->createSectionsAndSteps($admin->courses);

        $users = User::factory()->count(2)->create();

        // Get the courses lazy loaded with certificate
        $coursesByAdmin = Course::whereIn('id', $admin->courses->pluck('id'))->with('certificate')->get();

        // Create certificate for each course
        $this->createCertifications($coursesByAdmin);

        foreach ($users as $user) {
            // enroll the users into the courses created by admin
            $user->enrolledCourses()->toggle($coursesByAdmin->pluck('id'));
        }

        $firstCourse = $user->enrolledCourses[0]->with('sections.steps')->first();

        $sections = $firstCourse->sections;
        $stepsIds = []; // the ids of the steps of the sections

        foreach ($sections as $section) {
            $stepsIds =  array_merge($stepsIds, $section->steps->pluck('id')->toArray());
        }

        foreach ($users as $user) {
            // complete the steps of the sections
            $user->steps()->attach($stepsIds);

            // complete the first enrolled course of the user
            $this->completeAnEnrolledCourse($user, $firstCourse);
        }
    }

    /**
     * Create sections and setps for each course
     */
    public function createSectionsAndSteps(Collection $courses): void
    {
        foreach ($courses as $course) {
            $sections = Section::factory()->count(3)->create([
                'courseId' => $course->id,
            ]);
            $this->createSteps($sections);
        }
    }

    /**
     * Create steps for each section
     */
    public function createSteps(Collection $sections): void
    {
        // Create steps for each section of the course
        foreach ($sections as $section) {
            // Create a reading step
            Step::factory()->reading()->create([
                'sectionId' => $section->id,
            ]);

            // Create a video step
            Step::factory()->video()->create([
                'sectionId' => $section->id,
            ]);

            // Create a quiz step
            $quiz = Step::factory()->quiz()->create([
                'sectionId' => $section->id,
            ]);

            // Create two questions for the quiz
            $questions = Question::factory()->count(2)->create([
                'stepId' => $quiz->id
            ]);

            // Create three answers for each question of the quiz
            foreach ($questions as $question) {
                // Create two incorrect answers
                Answer::factory()->count(2)->create([
                    'questionId' => $question->id,
                ]);

                // Create one correct answer
                Answer::factory()->correct()->create([
                    'questionId' => $question->id,
                ]);
            }
        }
    }

    /**
     * Create certificate for each course
     */
    public function createCertifications(Collection $courses): void
    {
        foreach ($courses as $course) {
            Certificate::factory()->create([
                'courseId' => $course->id,
            ]);
        }
    }

    /**
     * Complete first course of each user and grant the certificate
     */
    public function completeFirstCourse(Collection $users)
    {
        foreach ($users as $user) {

            $firstEnrolledCourse = $user->enrolledCourses[0]->with('certificate')->first(); // Get the the first course the user enrolled

            // completing a course the user is enrolling
            $user->enrolledCourses()->updateExistingPivot($firstEnrolledCourse->id, [
                'status' => 'completed',
            ]);

            // Granting the user the certificate of the completed course
            $user->certificates()->attach($firstEnrolledCourse->certificate->id);
        }
    }

    /**
     * Complete an ernolled course of the user
     */
    public function completeAnEnrolledCourse(User $user, Course $courseComplete): void
    {
        $sections = $courseComplete->sections;
        $stepsIds = []; // the ids of the steps of the sections

        foreach ($sections as $section) {
            $stepsIds =  array_merge($stepsIds, $section->steps->pluck('id')->toArray());
        }

        $setpIdsCompletedByUser = $user->steps->pluck('id')->toArray();  // the ids of the steps already completed by the user

        if (array_intersect($setpIdsCompletedByUser, $stepsIds) !== $stepsIds) { // check if the all the step ids of the course to be completed are already completed by the user or not
            throw new Exception("Not all tasks are completed yet to complete the whole course");
        }

        // completing a course the user is enrolling
        $user->enrolledCourses()->updateExistingPivot($courseComplete->id, [
            'status' => 'completed',
        ]);

        // Granting the user the certificate of the completed course
        $user->certificates()->attach($courseComplete->certificate->id);
    }
}
