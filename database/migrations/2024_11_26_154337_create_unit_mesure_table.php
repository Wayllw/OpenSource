<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UnitMesure', function (Blueprint $table) {
            $table->id()->unique();
            $table->string("unitMesure")->unique();
            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();             
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
        Schema::dropIfExists('UnitMesure');
    }
};
