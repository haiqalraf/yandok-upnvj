<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTujuanAndAlamatToLegalisirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legalisir', function (Blueprint $table) {
            $table->integer("tujuan")->nullable()->after("keterangan");
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
        Schema::table('legalisir', function (Blueprint $table) {
            $table->dropColumn('tujuan');
            $table->dropColumn('alamat');
        });
    }
}
