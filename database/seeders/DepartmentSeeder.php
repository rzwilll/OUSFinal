<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'id' => '1',
                'department_name' => 'Information Technology'
            ],
           [
                'id' => '2',
                'department_name' => 'Computer Application'
            ],
            [
                'id' => '3',
                'department_name' => 'Computer Science'
            ]

        ];
        Department::insert($data);
        
    }
}
