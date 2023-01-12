<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\YearLevel;


class YearLevelSeeder extends Seeder
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
                'id' => ' 1',
                'year_level' => '1'
            ],
            [
                'id' => ' 2',
                'year_level' => '2'
            ],
            [
                'id' => ' 3',
                'year_level' => '3'
            ],
            [
                'id' => ' 4',
                'year_level' => '4'
            ]
        ]; 
        YearLevel::insert($data);
    }
}
