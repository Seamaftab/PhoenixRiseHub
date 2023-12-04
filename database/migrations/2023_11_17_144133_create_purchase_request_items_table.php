<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_request_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_title');
            $table->decimal('quantity');
            $table->float('estimated_cost',8,2);
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_request_items');
    }
};
