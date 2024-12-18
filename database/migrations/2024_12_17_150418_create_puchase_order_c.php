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
        Schema::create('PurchaseOrderC', function (Blueprint $table) {
            $table->id();
            $table->double('discount');
            $table->integer('pODate')->nullable();
            $table->text('pOObservation')->nullable();
            $table->integer('pONumber');
            $table->tinyInteger('status');
            $table->integer('supplierCode');
            $table->double('total');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('PurchaseOrderC');
    }
};
