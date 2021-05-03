<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->integer('modelo_id')->unsigned();
            $table->string('CodProducto');
            $table->string('DenominacionComercial');
            $table->string('IdProducto');
            $table->string('Katashiki');
            $table->string('ProductionSuffix');
            $table->string('SalesSuffix');
            $table->string('SalesSuffixDescription');
            $table->string('Version');
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
        Schema::dropIfExists('versions');
    }
}
