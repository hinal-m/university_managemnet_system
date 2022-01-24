<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Vivekanand College',
                'email' => 'vvk@gmail.com',
                'contact_no' => '1485963270',
                'address' => 'Olpad Rd, near Jakat Naka, Jahangir Pura, Surat, Gujarat 395005',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Government Polytechnic For Girls',
                'email' => 'gpg@gmail.com',
                'contact_no' => '8347837580',
                'address' => 'Athvaget , Surat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'KGK Academy',
                'email' => 'kg@gmail.com',
                'contact_no' => '9874563214',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'DRB',
                'email' => 'drb@gmail.com',
                'contact_no' => '5645645645',
                'address' => 'Ingleburn Road, Ingleburn NSW, Australia
                Ingleburn Road',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Sarvajanik College of Physiotherapy, Surat',
                'email' => 'sp@gmail.com',
                'contact_no' => '7896541234',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Sardar Vallabhbhai National Institute Technology, Surat',
                'email' => 'svn@gmail.com',
                'contact_no' => '8521479632',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'LN College Of Management & Technology (LNCMT), Surat',
                'email' => 'lncm@gmail.com',
                'contact_no' => '8521479637',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Bhagwan Mahavir College of Management, Surat',
                'email' => 'bmcm@gmail.com',
                'contact_no' => '8521479638',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'SHRIMAD RAJCHANDRA SCHOOL OF SPORTS, Surat',
                'email' => 'srss@gmail.com',
                'contact_no' => '7896541238',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Government Polytechnic, Dang',
                'email' => 'gp@gmail.com',
                'contact_no' => '9632587412',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'KP Vidhyapth College',
                'email' => 'kp@gmail.com',
                'contact_no' => '4587452145',
                'address' => '678,nagar prathmik ,bank of baroda',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Evening Commerce College, Surat',
                'email' => 'ecc@gmail.com',
                'contact_no' => '7896541236',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Maan College of Paramedical Sciences, Bhopal',
                'email' => 'mcps@gmail.com',
                'contact_no' => '7896541232',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'KJ Somaiya Polytechnic - Somaiya Vidyavihar, Mumbai',
                'email' => 'kjs@gmail.com',
                'contact_no' => '8521479639',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Arvind Mahila College, Patna',
                'email' => 'amp@gmail.com',
                'contact_no' => '7412589632',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Johri Professional College, Bhopal',
                'email' => 'jpc@gmail.com',
                'contact_no' => '8521479699',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'DR Patel and RB Patel Commerce College, Surat',
                'email' => 'drp@gmail.com',
                'contact_no' => '8521478888',
                'address' => 'Surat, Gujarat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Government Polytechnic For Girls ( GPG )',
                'email' => 'gpgs@gmail.com',
                'contact_no' => '4789451203',
                'address' => 'Surat, Gujrat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'C.K Pithavala Technology',
                'email' => 'contact@ckpcet.ac.in',
                'contact_no' => '6355055839',
                'address' => 'Near Malvan Mandir Via Magdalla Port, Dumas Rd, Surat, Gujarat 395007',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Vidhyadeep – Vidhyadeep Campus',
                'email' => 'v@gmail.com',
                'contact_no' => '85232145698',
                'address' => 'Surat, Gujrat',
                'password' => Hash::make('password'),
                'logo' => 'abc.jpg',
                'status' => '1',
            ],
        ];
        College::insert($data);
    }
}
