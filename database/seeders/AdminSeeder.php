<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => "administrator",
            'email' => "admin@gmail.com",
            'password' => Hash::make('default_password'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user->assignRole('adminRole');
    }
}
