<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enum\UserRoleEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::factory()->create([
             'role' => UserRoleEnum::ADMIN,
             'name' => 'Admin',
             'password' => '1234',
             'email' => 'admin@admin.com',
         ]);
    }
}
