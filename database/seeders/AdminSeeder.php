<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['name' => 'Admin',
             'email' => 'admin@admin.com',
              'password' => Hash::make('admin123'),
              'role' => 'admin',
              ]
        );

        $this->command->info('Admin created : admin@admin.com / admin123');
    }
}
