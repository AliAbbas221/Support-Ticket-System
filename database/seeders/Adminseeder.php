<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'yasser',
            'email' =>'yasser55@gmail.com',
            'role'  =>'Admin',
            'password' => 'admin123456789'
        ]);
    }
}
