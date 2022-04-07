<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Zeca',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->times(10)->create();
    }
}
