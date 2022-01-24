<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->truncate();

        University::insert([
            'name' => 'GTU',
            'email' => 'admin@admin.com',
            'address' => 'Gujarat Technological University
            Nr.Vishwakarma Government Engineering College Nr.Visat Three Roads, Visat - Gandhinagar Highway
            Chandkheda, Ahmedabad - 382424 - Gujarat',
            'contact_no' => '079 2326 7521',
            'password' => Hash::make('admin@123'),
        ]);
    }
}
