<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_user = new User();
        $admin_user->first_name = 'Master';
        $admin_user->last_name = 'Admin';
        $admin_user->email = 'MasterAdmin@admin.com';
        $admin_user->age = '99';
        $admin_user->password =  Hash::make('admin99');
        $admin_user->phone = '+990123456789';
        $admin_user->save();

        $admin_user->assignRole('admin');
    }
}
