<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         $this->call([  
            AdminUserSeeder::class,
            YearLevelSeeder::class,
            AcadYearSeeder::class,
            AcadTermSeeder::class,
            DepartmentSeeder::class,
            ProgramSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            SubjectGradeSeeder::class, 
            AdviseeSeeder::class,
            AdviserSeeder::class
        //      StudentSeeder::class,
        //     //SubjectGradeSeeder::class,
        //     //SSubjectSeeder::class,
    
         ]);
        
        //  $this -> call(AdminUserSeeder::class);
        
    }
}
