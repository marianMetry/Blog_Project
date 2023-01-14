<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email' , 'admin@admin.com')->first();

        if(!$user)
        {
            User::create([
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('123456'),
                'role'=>'admin'
            ]);
        }
    }
}
