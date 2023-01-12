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
        Schema:: create('report_pdfs', function (Blueprint $table)
        {
            $table -> id();
            $table -> unsignedBigInteger('report_id');
            $table->string('pdf_path');
            $table->binary('pdf_file');
            $table ->foreign('report_id')
                ->references('id')
                ->on('reports')
                ->onDelete('cascade');
            
            $table -> timestamps();

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
