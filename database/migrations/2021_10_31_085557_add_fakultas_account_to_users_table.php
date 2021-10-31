<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddFakultasAccountToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert('insert into users (name, nim, fakultas, password, is_admin) values (?, ?, ?, ?, ?)', ['Dekanat Fakultas Ekonomi dan Bisnis', '18101', 'FEB', bcrypt('123456'), '3']);
        DB::insert('insert into users (name, nim, fakultas, password, is_admin) values (?, ?, ?, ?, ?)', ['Dekanat Fakultas Kedokteran','18102', 'FKD', bcrypt('123456'), '3']);
        DB::insert('insert into users (name, nim, fakultas, password, is_admin) values (?, ?, ?, ?, ?)', ['Dekanat Fakultas Teknik','18103', 'FTK', bcrypt('123456'), '3']);
        DB::insert('insert into users (name, nim, fakultas, password, is_admin) values (?, ?, ?, ?, ?)', ['Dekanat Fakultas Ilmu Sosial dan Ilmu Politik','18104', 'FSP', bcrypt('123456'), '3']);
        DB::insert('insert into users (name, nim, fakultas, password, is_admin) values (?, ?, ?, ?, ?)', ['Dekanat Fakultas Ilmu Komputer','18105', 'FIK', bcrypt('123456'), '3']);
        DB::insert('insert into users (name, nim, fakultas, password, is_admin) values (?, ?, ?, ?, ?)', ['Dekanat Fakultas Hukum','18106', 'FHK', bcrypt('123456'), '3']);
        DB::insert('insert into users (name, nim, fakultas, password, is_admin) values (?, ?, ?, ?, ?)', ['Dekanat Fakultas Ilmu Kesehatan','18107', 'FKS', bcrypt('123456'), '3']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('nim', '18101')->delete();
        DB::table('users')->where('nim', '18102')->delete();
        DB::table('users')->where('nim', '18103')->delete();
        DB::table('users')->where('nim', '18104')->delete();
        DB::table('users')->where('nim', '18105')->delete();
        DB::table('users')->where('nim', '18106')->delete();
        DB::table('users')->where('nim', '18107')->delete();
    }
}
