<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = [
            'administrator_id'      => 'AD0001',
            'administrator_name'    => 'Yong Zi Hean',
            'email'                 => 'yzh@gmail.com',
            'password'              => Hash::make(123456),
            'administrator_contact' => '0109089667',
            'administrator_DOB'     => date('Y-m-d'),
            'registration_date'     => date('Y-m-d'),
            'registration_status'     => 'Success',
        ];

        Administrator::create($administrator);
    }

}
