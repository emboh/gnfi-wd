<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ])->assignRole(
            Role::findByName(Role::ADMIN)
        );

        User::create([
            'name' => 'Member',
            'email' => 'member@example.com',
            'password' => bcrypt('password'),
            'points' => 200,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ])->assignRole(
            Role::findByName(Role::MEMBER)
        );

        User::factory(5)->create()->each(function ($user) {
            $user->assignRole(
                Role::findByName(Role::ADMIN)
            );
        });

        User::factory(5)->create()->each(function ($user) {
            $user->assignRole(
                Role::findByName(Role::MEMBER)
            );
        });
    }
}
