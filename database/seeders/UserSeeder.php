<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'nama' => 'Admin',
            'password' => '$2y$12$DCGZEXK/TseJDQSfnJan.OVTT5Votu17jKSyaIOOVWrZly6GTTNGu',
            'created_at' => '2025-02-03 12:54:14',
            'updated_at' => '2025-02-03 12:54:14',
            'username' => 'admin',
            'department_id' => 1,
        ]);
    }
}
