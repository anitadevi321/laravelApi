<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user_registration;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user_registration::create([
            'name'=>'anita',
            'email'=>'anita321@gmail.com',
            'password'=>'anita321',
            'phone'=>8264930805
        ]);
    }
}
