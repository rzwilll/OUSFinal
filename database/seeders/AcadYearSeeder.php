<?php

namespace Database\Seeders;
use App\Models\AcadYear;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AcadYearSeeder extends Seeder
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
                'id' => '1',
                'acad_yr' => '2020-2021',
                'status' => 0
            ],
            [
                'id' => '2',
                'acad_yr' => '2021-2022',
                'status' => 1
            ]

            ];

            AcadYear::insert($data);
    }
        
}
