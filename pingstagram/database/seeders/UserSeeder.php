<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            ['account' => 'admin', 'password' => Hash::make('admin'), 'name' => '관리자', 'gender' => '0','profile' => '/profile/trustping.png'],
            ['account' => 'admin2', 'password' => Hash::make('admin'), 'name' => '관리자2', 'gender' => '1','profile' => '/profile/fluffyping.png'],
            ['account' => 'admin3', 'password' => Hash::make('admin'), 'name' => '관리자3', 'gender' => '1','profile' => '/profile/chocoping.png'],
            ['account' => 'admin4', 'password' => Hash::make('admin'), 'name' => '관리자4', 'gender' => '1','profile' => '/profile/araping.png'],
        ];
        foreach($data as $item) {
            User::create($item);
        }
    }
}
