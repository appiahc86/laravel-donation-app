<?php

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
        if (\App\User::all()->count() < 1){
            \App\User::create([
                'name' => 'Ekene Emmanuel',
                'email' => 'ekene@gmail.com',
                'admin' => 1,
                'password' => \Illuminate\Support\Facades\Hash::make('password@1234')
            ]);
        }
    }
}
