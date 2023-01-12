<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //     $admin = User::create
    // (  
    //      [ 
    //         'id' => '1',
    //         'name' => 'Maria Cali',
    //         'email' => 'mariacali@example.com',
    //         'email_verified_at' => now(),
    //         'password' => bcrypt('it12345678'), // password
    //         // 'remember_token' => Str::random(10),
    //     ],
    //     [ 
    //         'id' => '2',
    //         'name' => 'Lailah Lima',
    //         'email' => 'lailahlima@example.com',
    //         'email_verified_at' => now(),
    //         'password' => bcrypt('it67891011'), // password
    //         // 'remember_token' => Str::random(10),
    //     ],
    //     [ 
    //         'id' => '3',
    //         'name' => 'Tin Pinlac',
    //         'email' => 'tinpinlac@example.com',
    //         'email_verified_at' => now(),
    //         'password' => bcrypt('cs12345678'), // password
    //         // 'remember_token' => Str::random(10),
    //     ],
    //     [ 
    //         'id' => '4',
    //         'name' => 'Prince Bangkero',
    //         'email' => 'princebangkero@example.com',
    //         'email_verified_at' => now(),
    //         'password' => bcrypt('cs67891011'), // password
    //         // 'remember_token' => Str::random(10),
    //     ],
    //     [ 
    //         'id' => '5',
    //         'name' => 'Hayley Styles',
    //         'email' => 'hayleystyleso@example.com',
    //         'email_verified_at' => now(),
    //         'password' => bcrypt('cs123456789'), // password
    //         // 'remember_token' => Str::random(10),
    //     ],
    
    
    
    // );
    
    $data =[
        [ 
             'id' => '1',
             'name' => 'Maria Cali',
             'email' => 'mariacali@example.com',
             'is_admin' => '0',
             'email_verified_at' => now(),
             'password' => bcrypt('it12345678'), // password
             'remember_token' => Str::random(10),
           
        ],
        [ 
            'id' => '2',
            'name' => 'Lailah Lima',
            'email' => 'lailahlima@example.com',
            'is_admin' => '0',
            'email_verified_at' => now(),
            'password' => bcrypt('it67891011'), // password
            'remember_token' => Str::random(10),
          
       ],
       [ 
            'id' => '3',
            'name' => 'Tin Pinlac',
            'email' => 'tinpinlac@example.com',
            'is_admin' => '0',
            'email_verified_at' => now(),
            'password' => bcrypt('cs1234567'), // password
            'remember_token' => Str::random(10),
            
        ],
        [ 
            'id' => '4',
            'name' => 'Prince Bangkero',
            'email' => 'princebangkero@example.com',
            'is_admin' => '0',
            'email_verified_at' => now(),
            'password' => bcrypt('cs67891011'), // password
            'remember_token' => Str::random(10),
        ],
        [ 
            'id' => '5',
            'name' => 'Hayley Styles',
            'email' => 'hayleystyles@example.com',
            'is_admin' => '0',
            'email_verified_at' => now(),
            'password' => bcrypt('cs123456789'), // password
            'remember_token' => Str::random(10),
       ],
       [ 
            'id' => '6',
            'name' => 'Cris Santos ',
            'email' => 'crissantos@example.com',
            'is_admin' => '0',
            'email_verified_at' => now(),
            'password' => bcrypt('it123456789'), // password
            'remember_token' => Str::random(10),
        ],
        [ 
            'id' => '7',
            'name' => 'Mic Onz',
            'email' => 'miconz@example.com',
            'is_admin' => '1',
            'email_verified_at' => now(),
            'password' => bcrypt('it1011121314'), // password
            'remember_token' => Str::random(10),
        ],

    ];
    User::insert($data);
    }
}

