<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::updateOrCreate([
            'name' => 'admin'
        ]);

        $user = new User();
        $user->name = 'Administrator';
        $user->login = 'admin';
        $user->password = 'bot2024';
        $user->save();

        $user->assignRole($role);
    }
}
