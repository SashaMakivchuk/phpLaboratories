<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'code' => '1',
            'author' => 'auth1',
            'budget' => 10000,
            'rating1' => 6,
            'rating2' => 4,
            'rating3' => 5,
            'creator_user_id' =>null
        ]);

        Project::create([
            'code' => '2',
            'author' => 'auth2',
            'budget' => 15000,
            'rating1' => 7,
            'rating2' => 8,
            'rating3' => 5,
            'creator_user_id' =>null
        ]);

        Project::create([
            'code' => '3',
            'author' => 'auth3',
            'budget' => 8000,
            'rating1' => 4,
            'rating2' => 2,
            'rating3' => 5,
            'creator_user_id' =>null
        ]);

        Project::create([
            'code' => '4',
            'author' => 'auth4',
            'budget' => 12000,
            'rating1' => 5,
            'rating2' => 9,
            'rating3' => 2,
            'creator_user_id' =>null
        ]);

        Project::create([
            'code' => '5',
            'author' => 'auth5',
            'budget' => 20000,
            'rating1' => 9,
            'rating2' => 6,
            'rating3' => 5,
            'creator_user_id' =>null
        ]);
    }
}
