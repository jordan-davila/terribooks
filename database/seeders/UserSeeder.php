<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Jordan Davila',
            'email' => 'hi@jordandavila.com',
            'email_verified_at' => now(),
            'password' => bcrypt('allsop55'),
        ]);

        $congregation = Team::factory()->create([
            'name' => 'West Newark',
            'user_id' => $user,
            'personal_team' => false,
        ]);
    }
}
