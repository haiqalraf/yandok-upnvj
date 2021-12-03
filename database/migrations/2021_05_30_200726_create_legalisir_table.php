<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalisirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('legalisir');
        Schema::create('legalisir', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string ('nim_pemesan',255)->nullable();
            $table->decimal('dok_01',32)->nullable()->default(0.00);
            $table->decimal('dok_02',32)->nullable()->default(0.00);
            $table->decimal('dok_03',32)->nullable()->default(0.00);
            $table->decimal('dok_04',32)->nullable()->default(0.00);
            $table->decimal('dok_05',32)->nullable()->default(0.00);
            $table->decimal('dok_06',32)->nullable()->default(0.00);
            $table->decimal('dok_07',32)->nullable()->default(0.00);
            $table->decimal('dok_08',32)->nullable()->default(0.00);
            $table->decimal('dok_09',32)->nullable()->default(0.00);
            $table->decimal('dok_10',32)->nullable()->default(0.00);
            $table->decimal('dok_11',32)->nullable()->default(0.00);
            $table->decimal('dok_12',32)->nullable()->default(0.00);
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
        Schema::dropIfExists('legalisir');
    }
}
