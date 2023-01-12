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
        Schema:: create('students', function (Blueprint $table)
        {
            $table -> id();
            $table -> string('stud_idnum');
            $table -> string('stud_last');
            $table -> string('stud_first');
            $table -> string('stud_mi');
            $table -> unsignedBigInteger('program_id');
            $table -> foreign('program_id')
                    ->references('id')
                    -> on('programs')
                    -> onDelete('cascade');
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
