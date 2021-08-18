<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail1 = [
                    'email' => 'gumilang.dev@gmail.com',
                    'phone' => '085795327357',
                    'address' => ''
        ];

        $detail2 = [
                    'email' => 'customer@gmail.com',
                    'phone' => '',
                    'address' => ''
        ];

        $detail3 = [
                    'email' => 'admin@gmail.com',
                    'phone' => '',
                    'address' => ''
        ];

        $user = [
            [
                'username' => "ilhammeru",
                'password' => Hash::make('ilhammeru'),
                'role' => 1,
                'detail' => json_encode($detail1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'username' => "admin",
                'password' => Hash::make('admin'),
                'role' => 2,
                'detail' => json_encode($detail3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'username' => "customer",
                'password' => Hash::make('customer'),
                'role' => 1,
                'detail' => json_encode($detail2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ]
        ];

        User::insert($user);
    }
}
