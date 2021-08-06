<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakultas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
        });
        DB::insert('insert into fakultas (id, nama) values (?, ?)', ['FIK', 'Fakultas Ilmu Komputer']);
        DB::insert('insert into fakultas (id, nama) values (?, ?)', ['FKD', 'Fakultas Kedokteran']);
        DB::insert('insert into fakultas (id, nama) values (?, ?)', ['FKS', 'Fakultas Ilmu Kesehatan']);
        DB::insert('insert into fakultas (id, nama) values (?, ?)', ['FSP', 'Fakultas Ilmu Sosial dan Ilmu Politik']);
        DB::insert('insert into fakultas (id, nama) values (?, ?)', ['FEB', 'Fakultas Ekonomi dan Bisnis']);
        DB::insert('insert into fakultas (id, nama) values (?, ?)', ['FTK', 'Fakultas Teknik']);
        DB::insert('insert into fakultas (id, nama) values (?, ?)', ['FHK', 'Fakultas Hukum']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fakultas');
    }
}
