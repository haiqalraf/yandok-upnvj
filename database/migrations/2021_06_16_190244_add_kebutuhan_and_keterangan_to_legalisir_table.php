<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKebutuhanAndKeteranganToLegalisirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legalisir', function (Blueprint $table) {
            $table->string("kebutuhan")->nullable()->after("file");
            $table->text("keterangan")->nullable()->after("kebutuhan");
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
            $table->dropColumn('kebutuhan');
            $table->dropColumn('keterangan');
        });
    }
}
