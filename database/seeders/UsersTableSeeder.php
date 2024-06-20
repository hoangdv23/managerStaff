<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Đinh Việt Hoàng',
            'username' => 'hoangdv',
            'email' => 'hoangdv.ptit@gmail.com',
            'phone'=> '0123456789',
            'password' => bcrypt('123456'),
            'status' => 1,
            ]);
    }
}
