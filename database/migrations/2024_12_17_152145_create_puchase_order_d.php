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
        Schema::create('purchaseOrderD', function (Blueprint $table) {
            $table->id();
            $table->double('deliveredQuantity');
            $table->double('discount');
            $table->integer('pODateDelivery')->nullable();
            $table->integer('pONumber');
            $table->text('productCode');
            $table->text('productFamily');
            $table->text('productUnit');
            $table->double('quantity')->nullable();
            $table->double('sellingPrice')->nullable();
            $table->tinyInteger('status');
            $table->integer('taxRateCode');
            $table->double('unitPrice')->nullable();
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
        Schema::dropIfExists('purchaseOrderD');
    }
};
