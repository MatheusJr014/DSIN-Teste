<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Users;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {  
        Users::create([
            'username'=>'Admin',
            'useremail'=>'admin@admin.com',
            'role'=> 'admin',
            'password'=> bcrypt('admin123')
        ]);

    }
}
