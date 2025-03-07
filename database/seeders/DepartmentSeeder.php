<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('departments')->insert([
            [
                'department_id' => 1,
                'department_name' => 'Admin',
                'department_username' => 'Admin',
            ],
        ]);
    }
}
