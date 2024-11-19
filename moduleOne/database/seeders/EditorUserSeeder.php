<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class EditorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('email', 'editor@gmail.com')->doesntExist()) {
            User::create([
                'name' => 'Editor User',
                'email' => 'editor@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'editor'
            ]);
        }
    }
}
