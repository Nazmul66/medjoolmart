<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('147852369');
        $adminRecords = [
           ['id' => 1, "name" => "Nazmul Hassan", "type" => "admin", "phone" => "01930260802", "email" => "hnazmul748@gmail.com", "password" => $password, "image" => "", 'status' => 1]
        ];

        Admin::insert($adminRecords);
    }
}
