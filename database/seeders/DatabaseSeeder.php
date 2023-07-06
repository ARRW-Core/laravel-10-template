<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 's.admin@mail.com',
            'password' => bcrypt('asd#@#123'),
        ])->assignRole('super_admin');
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('admin');
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('user123'),
        ])->assignRole('user');



    }
}
