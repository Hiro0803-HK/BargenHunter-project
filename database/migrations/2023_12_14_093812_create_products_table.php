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
        Schema::create('products', function (Blueprint $table) {
            //$table->id();
            //$table->unsignedBigInteger('id')->autoIncrement();
            $table->id();
            $table->string('product_name', 100);
            $table->foreignId('category_id')->constrained();
            $table->string('image', 255)->nullable();
            $table->timestamps();

            //$table->primary(['id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
