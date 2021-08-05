<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTracerStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tracer_studies', function (Blueprint $table) {
            $table->text("alamat_kerja")->nullable()->after("jabatan");
            $table->date("tanggal_kerja")->nullable()->after("alamat_kerja");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracer_studies', function (Blueprint $table) {
            $table->dropColumn('alamat_kerja');
            $table->dropColumn('tanggal_kerja');
        });
    }
}
