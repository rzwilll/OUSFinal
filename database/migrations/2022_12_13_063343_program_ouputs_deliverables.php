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
         Schema:: create('program_outputs_deliverables', function (Blueprint $table)
        {
            $table -> id();
            $table -> unsignedBigInteger('report_id');
           
            $table -> string('outputs_desc')->nullable();
            $table -> string('deliverables_desc')->nullable();
       
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
