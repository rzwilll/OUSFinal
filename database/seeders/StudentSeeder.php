<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;


class StudentSeeder extends Seeder
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
        // IT STUDENTS
            [ 
                'id' => '1',
                'stud_idnum' => '2020-0319',
                'stud_last' => 'Acevedo',
                'stud_first' => 'Ariel',
                'stud_mi' => 'P.',
                'program_id' => '1'

            ],
            [ 
                'id' => '2',
                'stud_idnum' => '2020-1073',
                'stud_last' => 'Benevido',
                'stud_first' => 'Felton',
                'stud_mi' => 'T.',
                'program_id' => '1'

            ],
            [ 
                'id' => '3',
                'stud_idnum' => '2020-2188',
                'stud_last' => 'Benson',
                'stud_first' => 'Elnora',
                'stud_mi' => 'Z.',
                'program_id' => '1'

            ],
            [ 
                'id' => '4',
                'stud_idnum' => '2020-1975',
                'stud_last' => 'Carney',
                'stud_first' => 'Harlan',
                'stud_mi' => 'F.',
                'program_id' => '1'

            ],
            [ 
                'id' => '5',
                'stud_idnum' => '2020-1586',
                'stud_last' => 'Cooley',
                'stud_first' => 'Delbert',
                'stud_mi' => 'O.',
                'program_id' => '1'

            ],
            [ 
                'id' => '6',
                'stud_idnum' => '2020-1171',
                'stud_last' => 'Doyle',
                'stud_first' => 'William',
                'stud_mi' => 'S.',
                'program_id' => '1'

            ],
            [ 
                'id' => '7',
                'stud_idnum' => '2020-0973',
                'stud_last' => 'Foster',
                'stud_first' => 'Opelia',
                'stud_mi' => 'J.',
                'program_id' => '1'

            ],
            [ 
                'id' => '8',
                'stud_idnum' => '2020-2251',
                'stud_last' => 'Gordon',
                'stud_first' => 'Buck',
                'stud_mi' => 'P.',
                'program_id' => '1'

            ],
            [ 
                'id' => '9',
                'stud_idnum' => '2020-2639',
                'stud_last' => 'Hickman',
                'stud_first' => 'Theresa',
                'stud_mi' => 'Z.',
                'program_id' => '1'

            ],
            [ 
                'id' => '10',
                'stud_idnum' => '2020-1161',
                'stud_last' => 'Hubbard',
                'stud_first' => 'Sussane',
                'stud_mi' => 'V.',
                'program_id' => '1'

            ],
            [ 
                'id' => '11',
                'stud_idnum' => '2020-0205',
                'stud_last' => 'Norton',
                'stud_first' => 'Ali',
                'stud_mi' => 'J.',
                'program_id' => '1'

            ],
            [ 
                'id' => '12',
                'stud_idnum' => '2020-0734',
                'stud_last' => 'Randall',
                'stud_first' => 'Arturo',
                'stud_mi' => 'H.',
                'program_id' => '1'

            ],
            [ 
                'id' => '13',
                'stud_idnum' => '2020-0887',
                'stud_last' => 'Reynolds',
                'stud_first' => 'Antoine',
                'stud_mi' => 'U.',
                'program_id' => '1'

            ],
            [ 
                'id' => '14',
                'stud_idnum' => '2020-1270',
                'stud_last' => 'Rubio',
                'stud_first' => 'Rosie',
                'stud_mi' => 'A.',
                'program_id' => '1'

            ],
            [ 
                'id' => '15',
                'stud_idnum' => '2020-0378',
                'stud_last' => 'Rush',
                'stud_first' => 'Kristen',
                'stud_mi' => 'B.',
                'program_id' => '1'

            ],
            [ 
                'id' => '16',
                'stud_idnum' => '2020-1365',
                'stud_last' => 'Short',
                'stud_first' => 'Heather',
                'stud_mi' => 'Q.',
                'program_id' => '1'

            ], 
            [ 
                'id' => '17',
                'stud_idnum' => '2020-1599',
                'stud_last' => 'Taylor',
                'stud_first' => 'Juana',
                'stud_mi' => 'C.',
                'program_id' => '1'

            ],
            [ 
                'id' => '18',
                'stud_idnum' => '2020-1817',
                'stud_last' => 'Trujillo',
                'stud_first' => 'Dane',
                'stud_mi' => 'E.',
                'program_id' => '1'

            ],
            [ 
                'id' => '19',
                'stud_idnum' => '2020-1943',
                'stud_last' => 'Velasquez',
                'stud_first' => 'Cong',
                'stud_mi' => 'I.',
                'program_id' => '1'

            ],
            [ 
                'id' => '20',
                'stud_idnum' => '2020-2065',
                'stud_last' => 'Villegas',
                'stud_first' => 'Kris',
                'stud_mi' => 'P.',
                'program_id' => '1'

            ],

            // CS
            [ 
                'id' => '21',
                'stud_idnum' => '2020-0294',
                'stud_last' => 'Bentley',
                'stud_first' => 'Tabatha',
                'stud_mi' => 'P.',
                'program_id' => '2'

            ],
            [ 
                'id' => '22',
                'stud_idnum' => '2020-0594',
                'stud_last' => 'Blackburn',
                'stud_first' => 'Annie',
                'stud_mi' => 'T.',
                'program_id' => '2'

            ],
            [ 
                'id' => '23',
                'stud_idnum' => '2020-1312',
                'stud_last' => 'Chang',
                'stud_first' => 'Monique',
                'stud_mi' => 'P.',
                'program_id' => '2'

            ],
            [ 
                'id' => '24',
                'stud_idnum' => '2020-0443',
                'stud_last' => 'Christian',
                'stud_first' => 'Gerry',
                'stud_mi' => 'F.',
                'program_id' => '2'

            ],
            [ 
                'id' => '25',
                'stud_idnum' => '2020-0355',
                'stud_last' => 'Foster ',
                'stud_first' => 'Sondra',
                'stud_mi' => 'P.',
                'program_id' => '2'

            ],
            [ 
                'id' => '26',
                'stud_idnum' => '2020-0604',
                'stud_last' => 'Hill',
                'stud_first' => 'Candice',
                'stud_mi' => 'A.',
                'program_id' => '2'

            ],
            [ 
                'id' => '27',
                'stud_idnum' => '2020-0259',
                'stud_last' => 'Kaufman',
                'stud_first' => 'Phillip',
                'stud_mi' => 'B.',
                'program_id' => '2'

            ],
            [ 
                'id' => '28',
                'stud_idnum' => '2020-1774',
                'stud_last' => 'Knox',
                'stud_first' => 'Russ',
                'stud_mi' => 'P.',
                'program_id' => '2'

            ],
            [ 
                'id' => '29',
                'stud_idnum' => '2020-1535',
                'stud_last' => 'Medina',
                'stud_first' => 'Josef',
                'stud_mi' => 'X.',
                'program_id' => '2'

            ],
            [ 
                'id' => '30',
                'stud_idnum' => '2020-1037',
                'stud_last' => 'Nicholson',
                'stud_first' => 'Jean',
                'stud_mi' => 'V.',
                'program_id' => '2'

            ],
            [ 
                'id' => '31',
                'stud_idnum' => '2020-0369',
                'stud_last' => 'Patel ',
                'stud_first' => 'Marisa',
                'stud_mi' => 'J.',
                'program_id' => '2'

            ],
            [ 
                'id' => '32',
                'stud_idnum' => '2020-1530',
                'stud_last' => 'Phelps',
                'stud_first' => 'Rudy',
                'stud_mi' => 'P.',
                'program_id' => '2'

            ],
            [ 
                'id' => '33',
                'stud_idnum' => '2020-0928',
                'stud_last' => 'Ramsey',
                'stud_first' => 'Garret',
                'stud_mi' => 'B.',
                'program_id' => '2'

            ],
            [ 
                'id' => '34',
                'stud_idnum' => '2020-1392',
                'stud_last' => 'Rangel',
                'stud_first' => 'Allison',
                'stud_mi' => 'D.',
                'program_id' => '2'

            ],
            [ 
                'id' => '35',
                'stud_idnum' => '2020-0416',
                'stud_last' => 'Schultz',
                'stud_first' => 'Carrie',
                'stud_mi' => 'E.',
                'program_id' => '2'

            ],
            [ 
                'id' => '36',
                'stud_idnum' => '2020-1193',
                'stud_last' => 'Simmons',
                'stud_first' => 'Lenny',
                'stud_mi' => 'A.',
                'program_id' => '2'

            ],
            [ 
                'id' => '37',
                'stud_idnum' => '2020-1965',
                'stud_last' => 'Stanton',
                'stud_first' => 'Jarret',
                'stud_mi' => 'F.',
                'program_id' => '2'

            ],
            [ 
                'id' => '38',
                'stud_idnum' => '2020-1292',
                'stud_last' => 'Stephenson',
                'stud_first' => 'Willis',
                'stud_mi' => 'E.',
                'program_id' => '2'

            ],
            [ 
                'id' => '39',
                'stud_idnum' => '2020-1915',
                'stud_last' => 'Wolfe Fletcher',
                'stud_first' => 'Finn',
                'stud_mi' => 'H.',
                'program_id' => '2'

            ],
            [ 
                'id' => '40',
                'stud_idnum' => '2020-1630',
                'stud_last' => 'Zuniga',
                'stud_first' => 'Gerard',
                'stud_mi' => 'C.',
                'program_id' => '2'

            ],

            //CA

            [ 
                'id' => '41',
                'stud_idnum' => '2020-3187',
                'stud_last' => 'Alvarado',
                'stud_first' => 'Sharron',
                'stud_mi' => 'E.',
                'program_id' => '2'

            ],
            [ 
                'id' => '42',
                'stud_idnum' => '2020-2322',
                'stud_last' => 'Bates',
                'stud_first' => 'Debora',
                'stud_mi' => 'U.',
                'program_id' => '2'

            ],
            [ 
                'id' => '43',
                'stud_idnum' => '2020-2811',
                'stud_last' => 'Case',
                'stud_first' => ' Lorna',
                'stud_mi' => 'S.',
                'program_id' => '2'

            ],
            [ 
                'id' => '44',
                'stud_idnum' => '2020-2672',
                'stud_last' => 'Chang',
                'stud_first' => 'Dwight',
                'stud_mi' => 'A.',
                'program_id' => '2'

            ],
            [ 
                'id' => '45',
                'stud_idnum' => '2020-2200',
                'stud_last' => 'Estes',
                'stud_first' => 'Francine',
                'stud_mi' => 'W.',
                'program_id' => '2'

            ],
            [ 
                'id' => '46',
                'stud_idnum' => '2020-1125',
                'stud_last' => 'Cline',
                'stud_first' => 'Dominic',
                'stud_mi' => 'D.',
                'program_id' => '2'

            ],
            [ 
                'id' => '47',
                'stud_idnum' => '2020-3157',
                'stud_last' => 'Franco',
                'stud_first' => 'Patti',
                'stud_mi' => 'E.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '48',
                'stud_idnum' => '2020-1468',
                'stud_last' => 'Kerr',
                'stud_first' => 'Derek',
                'stud_mi' => 'A',
                'program_id' => '2'
                

            ],
            
            [ 
                'id' => '49',
                'stud_idnum' => '2020-0716',
                'stud_last' => 'Lawrence',
                'stud_first' => 'Rogelio',
                'stud_mi' => 'B.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '50',
                'stud_idnum' => '2020-1848',
                'stud_last' => 'Lowe',
                'stud_first' => 'Jorge',
                'stud_mi' => 'C.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '51',
                'stud_idnum' => '2020-3267',
                'stud_last' => 'Mcclain',
                'stud_first' => 'Guy',
                'stud_mi' => 'Q.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '52',
                'stud_idnum' => '2020-0810',
                'stud_last' => 'Mcclure',
                'stud_first' => 'Ronda',
                'stud_mi' => 'P.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '53',
                'stud_idnum' => '2020-2433',
                'stud_last' => 'Mendez',
                'stud_first' => 'Terri',
                'stud_mi' => 'C.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '54',
                'stud_idnum' => '2020-1906',
                'stud_last' => 'Orozco',
                'stud_first' => 'Benita',
                'stud_mi' => 'G.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '55',
                'stud_idnum' => '2020-3334',
                'stud_last' => 'Richardson',
                'stud_first' => 'Mohamed',
                'stud_mi' => 'C.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '56',
                'stud_idnum' => '2020-1434',
                'stud_last' => 'Tucher',
                'stud_first' => 'Rosalyn',
                'stud_mi' => 'K.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '57',
                'stud_idnum' => '2020-0073',
                'stud_last' => 'Weiss',
                'stud_first' => 'Etta',
                'stud_mi' => 'M.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '58',
                'stud_idnum' => '2020-2798',
                'stud_last' => 'Woods',
                'stud_first' => 'Burt',
                'stud_mi' => 'C.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '59',
                'stud_idnum' => '2020-3270',
                'stud_last' => 'Yoder',
                'stud_first' => 'Maragrita',
                'stud_mi' => 'M.',
                'program_id' => '2'
                

            ],
            [ 
                'id' => '60',
                'stud_idnum' => '2020-2898',
                'stud_last' => 'Zhang',
                'stud_first' => 'Ahmad',
                'stud_mi' => 'C.',
                'program_id' => '2'
                

            ],


            //IT 

            [ 
                'id' => '61',
                'stud_idnum' => '2020-0319',
                'stud_last' => 'Acevedo',
                'stud_first' => 'Ariel',
                'stud_mi' => 'P.',
                'program_id' => '1'

            ],
            [ 
                'id' => '62',
                'stud_idnum' => '2020-1073',
                'stud_last' => 'Benevido',
                'stud_first' => 'Felton',
                'stud_mi' => 'T.',
                'program_id' => '1'

            ],
            [ 
                'id' => '63',
                'stud_idnum' => '2020-2188',
                'stud_last' => 'Benson',
                'stud_first' => 'Elnora',
                'stud_mi' => 'Z.',
                'program_id' => '1'

            ],
            [ 
                'id' => '64',
                'stud_idnum' => '2020-1975',
                'stud_last' => 'Carney',
                'stud_first' => 'Harlan',
                'stud_mi' => 'F.',
                'program_id' => '1'

            ],
            [ 
                'id' => '65',
                'stud_idnum' => '2020-1586',
                'stud_last' => 'Cooley',
                'stud_first' => 'Delbert',
                'stud_mi' => 'O.',
                'program_id' => '1'

            ],
            [ 
                'id' => '66',
                'stud_idnum' => '2020-1171',
                'stud_last' => 'Doyle',
                'stud_first' => 'William',
                'stud_mi' => 'S.',
                'program_id' => '1'

            ],
            [ 
                'id' => '67',
                'stud_idnum' => '2020-0973',
                'stud_last' => 'Foster',
                'stud_first' => 'Opelia',
                'stud_mi' => 'J.',
                'program_id' => '1'

            ],
            [ 
                'id' => '68',
                'stud_idnum' => '2020-2251',
                'stud_last' => 'Gordon',
                'stud_first' => 'Buck',
                'stud_mi' => 'P.',
                'program_id' => '1'

            ],
            [ 
                'id' => '69',
                'stud_idnum' => '2020-2639',
                'stud_last' => 'Hickman',
                'stud_first' => 'Theresa',
                'stud_mi' => 'Z.',
                'program_id' => '1'

            ],
            [ 
                'id' => '70',
                'stud_idnum' => '2020-1161',
                'stud_last' => 'Hubbard',
                'stud_first' => 'Sussane',
                'stud_mi' => 'V.',
                'program_id' => '1'

            ],
            [ 
                'id' => '71',
                'stud_idnum' => '2020-0205',
                'stud_last' => 'Norton',
                'stud_first' => 'Ali',
                'stud_mi' => 'J.',
                'program_id' => '1'

            ],
            [ 
                'id' => '72',
                'stud_idnum' => '2020-0734',
                'stud_last' => 'Randall',
                'stud_first' => 'Arturo',
                'stud_mi' => 'H.',
                'program_id' => '1'

            ],
            [ 
                'id' => '73',
                'stud_idnum' => '2020-0887',
                'stud_last' => 'Reynolds',
                'stud_first' => 'Antoine',
                'stud_mi' => 'U.',
                'program_id' => '1'

            ],
            [ 
                'id' => '74',
                'stud_idnum' => '2020-1270',
                'stud_last' => 'Rubio',
                'stud_first' => 'Rosie',
                'stud_mi' => 'A.',
                'program_id' => '1'

            ],
            [ 
                'id' => '75',
                'stud_idnum' => '2020-0378',
                'stud_last' => 'Rush',
                'stud_first' => 'Kristen',
                'stud_mi' => 'B.',
                'program_id' => '1'

            ],
            [ 
                'id' => '76',
                'stud_idnum' => '2020-1365',
                'stud_last' => 'Short',
                'stud_first' => 'Heather',
                'stud_mi' => 'Q.',
                'program_id' => '1'

            ], 
            [ 
                'id' => '77',
                'stud_idnum' => '2020-1599',
                'stud_last' => 'Taylor',
                'stud_first' => 'Juana',
                'stud_mi' => 'C.',
                'program_id' => '1'

            ],
            [ 
                'id' => '78',
                'stud_idnum' => '2020-1817',
                'stud_last' => 'Trujillo',
                'stud_first' => 'Dane',
                'stud_mi' => 'E.',
                'program_id' => '1'

            ],
            [ 
                'id' => '79',
                'stud_idnum' => '2020-1943',
                'stud_last' => 'Velasquez',
                'stud_first' => 'Cong',
                'stud_mi' => 'I.',
                'program_id' => '1'

            ],
            [ 
                'id' => '80',
                'stud_idnum' => '2020-2065',
                'stud_last' => 'Villegas',
                'stud_first' => 'Kris',
                'stud_mi' => 'P.',
                'program_id' => '1'

            ],
            
            
            
            


        ];
        Student::insert($data);
    }
}
