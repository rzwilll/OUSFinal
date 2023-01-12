<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema:: create('subject_grades', function (Blueprint $table)
        {
            $table -> id();
            $table -> unsignedBigInteger('subject_id');
            $table -> string('grade');
            $table -> unsignedBigInteger('stud_id');
            $table -> unsignedBigInteger('term_id');

            $table -> string('year_level')->nullable();
            $table ->foreign('term_id')
                ->references('id')
                ->on('acad_terms')
                ->onDelete('cascade');
            
            $table ->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');
            $table ->foreign('stud_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
            
        }
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
