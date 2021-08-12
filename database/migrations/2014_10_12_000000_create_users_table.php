<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->string('password');
            $table->string('tanggal_lahir')->nullable();
            $table->string('thn_lulus')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_rumah')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->decimal('is_admin')->nullable()->default(0.00);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
