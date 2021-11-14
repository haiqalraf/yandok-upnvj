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
            $table->text ('dokumen_dipesan')->nullable();
            $table->text('file')->nullable();
            $table->text('final_dokumen')->nullable();
            $table->integer('verifikasi')->default(1);
            $table->integer('verifikasi_pengiriman')->nullable()->default(1);
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
