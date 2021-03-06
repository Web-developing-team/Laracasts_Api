<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Teacher;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
            TeacherSeeder::class,
            LessonsSeeder::class,
            VideoSeeder::class,
            PlansSeeder::class,
            TeamPlansSeeder::class,
        ]);
    }
}
