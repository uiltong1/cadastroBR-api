<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 80)->nullable();
            $table->string('cpf', 14)->nullable();
            $table->string('rg', 9);
            $table->dateTime('dtcadastro')->nullable();
            $table->dateTime('dtatualizacao');
            $table->unsignedBigInteger('usrinc')->nullable();
            $table->unsignedBigInteger('usratualizacao')->nullable();
            $table->date('nascimento');
            $table->string('localnasc')->nullable();
            $table->foreign('usrinc')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usratualizacao')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('cliente');
    }
}
