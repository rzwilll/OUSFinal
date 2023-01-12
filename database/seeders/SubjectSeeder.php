<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;


class SubjectSeeder extends Seeder
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
                'subject_code' => 'CCC100',
                'subject_name' => 'Fundamentals of Computing',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '2',
                'subject_code' => 'CCC101',
                'subject_name' => 'Computer Programming 1',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '3',
                'subject_code' => 'CCC102',
                'subject_name' => 'Computer Programming 2',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '4',
                'subject_code' => 'CCC121',
                'subject_name' => 'Data Structures and Algorithms',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '5',
                'subject_code' => 'CCC151',
                'subject_name' => 'Information Management',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '6',
                'subject_code' => 'GEC101',
                'subject_name' => 'Understanding the Self',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '7',
                'subject_code' => 'GEC102',
                'subject_name' => 'Purposive Communication',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '8',
                'subject_code' => 'MAT101',
                'subject_name' => 'Logic and Set Theory',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '9',
                'subject_code' => 'GEC104',
                'subject_name' => 'Mathematics in the Modern World',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '10',
                'subject_code' => 'GEC103',
                'subject_name' => 'The Contemporary World',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '11',
                'subject_code' => 'GEC104',
                'subject_name' => 'Mathematics in the Modern World',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '12',
                'subject_code' => 'GEC105',
                'subject_name' => 'Readings in Philippine History',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '13',
                'subject_code' => 'GEC106',
                'subject_name' => 'Art Appreciation',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '14',
                'subject_code' => 'GEC107',
                'subject_name' => 'Ethics',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '15',
                'subject_code' => 'GEC108',
                'subject_name' => 'Science, Technology and Society',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '16',
                'subject_code' => 'GEC109',
                'subject_name' => 'Life and Works of Rizal',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '17',
                'subject_code' => 'PEED01',
                'subject_name' => 'Exercise Prescription and Management',
                'subject_unit' =>'2'
                
            ],
            [
                'id' => '18',
                'subject_code' => 'PEED02',
                'subject_name' => 'Dance/ Martial Arts',
                'subject_unit' =>'2'
                
            ],
            [
                'id' => '19',
                'subject_code' => 'PEED03',
                'subject_name' => 'Individual/ Dual Sports/ Traditional / Recreational Games',
                'subject_unit' =>'2'
                
            ],
            [
                'id' => '20',
                'subject_code' => 'PEED04',
                'subject_name' => 'Team Sports',
                'subject_unit' =>'2'
                
            ],
            [
                'id' => '21',
                'subject_code' => 'NST001',
                'subject_name' => 'National Service Training Program 1',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '22',
                'subject_code' => 'NST002',
                'subject_name' => 'National Service Training Program 1',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '23',
                'subject_code' => 'MAT104',

                'subject_name' => 'Discrete Structures',
                'subject_unit' =>'2'
                
            ],
            [
                'id' => '24',
                'subject_code' => 'MAT051',
                'subject_name' => 'Calculus 1',
                'subject_unit' =>'5'
                
            ],
            [
                'id' => '25',
                'subject_code' => 'MAT061',
                'subject_name' => 'Calculus 2',
                'subject_unit' =>'5'
                
            ],
            [
                'id' => '26',
                'subject_code' => 'STN07',
                'subject_name' => 'Probability and Statistical Inference for Computing Systems',
                'subject_unit' =>'2'
                
            ],
            [
                'id' => '27',
                'subject_code' => 'STN07.1',
                'subject_name' => 'Probability and Statistical Inference for Computing Systems (Lab)',
                'subject_unit' =>'1'
                
            ],
            [
                'id' => '28',
                'subject_code' => 'FPE101',
                'subject_name' => 'Fundamental of Peace Education',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '29',
                'subject_code' => 'ITE131',
                'subject_name' => 'Computer Architecture and Operating Systems',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '30',
                'subject_code' => 'ITE112',
                'subject_name' => 'Algorithmic Graph Theory',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '31',
                'subject_code' => 'ITE125',
                'subject_name' => 'Introduction to Human Computer Interaction',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '32',
                'subject_code' => 'ITE132',
                'subject_name' => 'Fundamentals of Computer Networks',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '33',
                'subject_code' => 'FIL101',
                'subject_name' => 'Wika at Kultura sa Mapayapang Lipunan',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '34',
                'subject_code' => 'FIL102',
                'subject_name' => 'Ekokritisismo at Pagpapahalaga sa Kalikasan',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '35',
                'subject_code' => 'HIS003',
                'subject_name' => 'History of Filipino Muslims and Indigenous Peoples of MINSUPALA',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '36',
                'subject_code' => 'NIHONGGO',
                'subject_name' => 'Foreign Language Elective',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '37',
                'subject_code' => 'STN101',
                'subject_name' => 'Descriptive and Inferential Statistics',
                'subject_unit' =>'4'
                
            ],
            [
                'id' => '38',
                'subject_code' => 'CSC130',
                'subject_name' => 'Discrete Structures',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '39',
                'subject_code' => 'CSC142',
                'subject_name' => 'Automata, Computability, and Complexity',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '40',
                'subject_code' => 'CSC186',
                'subject_name' => 'Human – Computer Interaction',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '41',
                'subject_code' => 'CSC124',
                'subject_name' => 'Design and Analysis of Algorithms',
                'subject_unit' =>'3'
                
            ],
            [
                'id' => '42',
                'subject_code' => 'CSC112',
                'subject_name' => 'Computer Organization and Architecture',
                'subject_unit' =>'4'
                
            ],
            
        ];
        Subject::insert($data);
    }
}
