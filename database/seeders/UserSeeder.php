<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'MOHAMMED YASSINE EL AALOUCH',
            'email' => 'admin@admin.com',
            'username' => 'admin',

            'password' => Hash::make('1234'),
        ]);

        $ownerRole = Role::where('name', 'owner')->first();
        $user->assignRole($ownerRole);
    }
}
