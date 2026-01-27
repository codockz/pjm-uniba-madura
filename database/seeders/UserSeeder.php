<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Admin PJM Uniba',
            'email'=> 'admin_pjm@unibamadura.ac.id',
            'password' => Hash::make('admin12345')
        ]);
    }
}
