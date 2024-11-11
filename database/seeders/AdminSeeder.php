<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Delete the specified record if it exists
       User::where('email', 'adhikarimahesh2053@gmail.com')->delete();
       // add super admin 
       User::create([
        'name'=>'महेश अधिकारी बर्बरीक',
        'email'=>'adhikarimahesh2053@gmail.com',
        'password'=>Hash::make('mahesh@12345'),
        'is_admin'=>1
       ]);
    }
}
