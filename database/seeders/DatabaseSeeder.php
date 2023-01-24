<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Customers::factory(10)->create();
        Users::factory()->create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>'password',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        Services::factory()->create([
            'name'=>'Website Hosting',
        ]);
        Services::factory()->create([
            'name'=>'Email Hosting',
        ]);
        Services::factory()->create([
            'name'=>'Domain',
        ]);
        Services::factory()->create([
            'name'=>'Web Development',
        ]);
    }
}
