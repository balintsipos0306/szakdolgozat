<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Subscription::create([
            'name' => 'tesztfeliratkozó',
            'email' => 'test@sub.com',
        ]);

        User::create([
            'name' => 'tesztfelhasználó',
            'email' => 'webshop@test.com',
            'password' => 'password123',
            'role' => 'customer',
        ]);
    }
}
