<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            verifikasi_pengiriman,
            tujuan,
            biaya,
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
            verifikasi_pengiriman,
            tujuan,
            biaya,
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
            verifikasi_pengiriman,
            tujuan,
            biaya,
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
