<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = config('imi.admin');

        if (blank($admin['name']) || blank($admin['email']) || blank($admin['password'])) {
            return;
        }

        User::updateOrCreate(
            ['email' => $admin['email']],
            [
                'name' => $admin['name'],
                'password' => $admin['password'],
                'role' => 'admin',
            ],
        );
    }
}
