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
        Schema:: create('acad_terms', function (Blueprint $table)
        {
            $table ->id();
            $table ->string('acad_sem');
            $table ->unsignedBigInteger('acadyear_id');
            $table->foreign('acadyear_id')
                ->references('id')
                ->on('acad_years')
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
