<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string ('nim_pemesan')->nullable();
            $table->string ('dokumen_dipesan')->nullable();
            $table->integer('verifikasi')->default(1);
            $table->string('file')->nullable();
            $table->string('final_dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suket');
    }
}
