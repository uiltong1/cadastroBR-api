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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('perfil')->nullable();
            $table->dateTime('dtinc')->nullable();
            $table->dateTime('dtatualizacao');
            $table->rememberToken();
            $table->foreign('perfil')->references('id')->on('perfil')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

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
