<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileToLegalisirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legalisir', function (Blueprint $table) {
            $table->string('file')->nullable()->after('dok_12');
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
            $table->dropColumn('file');
        });
    }
}
