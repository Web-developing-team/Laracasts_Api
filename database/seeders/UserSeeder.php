<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@admin.com')->first())
        {
            $user = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }

        $user = User::where('email', 'admin@admin.com')->first();

        $user->assignRole('admin');

        $role = $user->roles->first();

        $permission = Permission::where('name', 'user_management')->first();

        $role->givePermissionTo($permission);

        User::factory()->count(500)->create();
        
        User::chunk(200, function($users){
            foreach ($users as $user) {
                $user->assignRole('member');
            }
        });


    }
}
