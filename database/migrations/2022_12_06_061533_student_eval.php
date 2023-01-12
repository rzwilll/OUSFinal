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
        Schema:: create('student_eval', function (Blueprint $table)
        {
            $table -> id();
            $table -> unsignedBigInteger('subject_grade_id');
            $table -> unsignedBigInteger('term_id');
            $table ->string('year_level');
            $table ->foreign('subject_grade_id')
                ->references('id')
                ->on('subject_grades')
                ->onDelete('cascade');
            $table ->foreign('term_id')
                ->references('id')
                ->on('acad_terms')
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
