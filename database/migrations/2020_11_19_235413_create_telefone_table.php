<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefone', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente');
            $table->string('numero')->nullable();
            $table->dateTime('dtinc')->nullable();
            $table->unsignedBigInteger('usrinc');
            $table->dateTime('dtatualizacao')->nullable();
            $table->unsignedBigInteger('usratualizacao')->nullable();
            $table->foreign('cliente')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreign('usrinc')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usratualizacao')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('telefone');
    }
}
