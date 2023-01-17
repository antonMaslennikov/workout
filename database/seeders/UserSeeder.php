<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Администратор',
        ]);

        DB::table('roles')->insert([
            'name' => 'Менеджер',
        ]);

        $user = User::create([
            'name' => 'Антон',
            'email' => 'anton.maslennikov@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$xs47dorHYrgj7eTjmYxcMebeHygN/mN6aR0FPJgeqdefs3gFQ4SVG', // admin 
        ]);

        $user->roles()->sync([1]);
    }
}
