<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLainyaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lainya', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string ('nim_pemesan')->nullable();
            $table->string ('dokumen_dipesan')->nullable();
            $table->decimal ('jumlah_dokumen',32)->nullable()->default(0.00);
            $table->string('file')->nullable();
            $table->string('final_dokumen')->nullable();
            $table->integer('verifikasi')->default(1);
            $table->integer('verifikasi_pengiriman')->nullable()->default(1);
            $table->string('resi')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('accepted_at')->nullable();
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
        Schema::dropIfExists('lainya');
    }
}
