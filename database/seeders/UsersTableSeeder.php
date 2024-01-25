<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name'=>'Amin','email'=>'din@gmail.com','password'=>'123456'],
            ['name'=>'din','email'=>'din123@gmail.com','password'=>'125456'],
            ['name'=>'al','email'=>'dalin@gmail.com','password'=>'123456']
        ];
        User::insert($users);
    }
}
