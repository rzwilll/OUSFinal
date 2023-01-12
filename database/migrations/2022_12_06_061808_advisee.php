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
        Schema:: create('advisees', function (Blueprint $table)
        {
            $table -> id();
            $table -> unsignedBigInteger('user_id');
            $table -> unsignedBigInteger('student_id');
            $table -> unsignedBigInteger('term_id');
            $table -> foreign('term_id')
                ->references('id')
                -> on('acad_terms')
                ->onDelete('cascade');
            $table -> foreign('user_id')
                ->references('id')
                -> on('users')
                ->onDelete('cascade');
            $table ->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
            
        });

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
