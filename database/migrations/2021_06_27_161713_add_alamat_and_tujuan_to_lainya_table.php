<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatAndTujuanToLainyaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lainya', function (Blueprint $table) {
            $table->integer("tujuan")->nullable()->after("final_dokumen");
            $table->text("alamat")->nullable()->after("tujuan");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lainya', function (Blueprint $table) {
            $table->dropColumn('tujuan');
            $table->dropColumn('alamat');
        });
    }
}