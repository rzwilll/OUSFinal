<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcadTerm;


class AcadTermSeeder extends Seeder
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
                'acad_sem' =>'1',
                'acadyear_id' => '1'
            ],
            [
                'id' => '2',
                'acad_sem' =>'2', 
                'acadyear_id' => '1'
            ],
            [
                'id' => '3',
                'acad_sem' => '1',
                'acadyear_id' => '2'
            ],
            [
                'id' => '4',
                'acad_sem' => '2',
                'acadyear_id' => '2'
            ]

        ];
        AcadTerm::insert($data);
    }
}
