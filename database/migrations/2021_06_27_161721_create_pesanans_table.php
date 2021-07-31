<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS PesananView");
        DB::statement("
        CREATE VIEW PesananView AS
        SELECT
            id,
            nim_pemesan,
            verifikasi,
            0 AS source_table,
            created_at,
            updated_at
        FROM
            legalisir
        UNION
        SELECT
            id,
            nim_pemesan,
            verifikasi,
            1 AS source_table,
            created_at,
            updated_at
        FROM
            suket
        UNION
        SELECT
            id,
            nim_pemesan,
            verifikasi,
            2 AS source_table,
            created_at,
            updated_at
        FROM
            lainya
        ORDER BY
            id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS PesananView");
    }
}
