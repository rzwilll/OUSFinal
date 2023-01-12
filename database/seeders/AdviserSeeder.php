<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adviser;


class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data =[
            [
                'id' =>'1', 
                'user_id' =>'3',
                'department_id' => '3'
            ],
            [
                'id' =>'2', 
                'user_id' =>'4',
                'department_id' => '3'
            ],
            [
                'id' =>'3', 
                'user_id' =>'5',
                'department_id' => '3'
            ],
            [
                'id' =>'4', 
                'user_id' =>'6',
                'department_id' => '1'
            ],
        ];
        Adviser::insert($data);

    }
}
