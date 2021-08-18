<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->state([
            'role_id' => 3
        ])->create();

        $teacher = Teacher::factory()->state(['username' => $user->name])->for($user)->create();


        Course::factory()->for($teacher)->create();

    }
}
