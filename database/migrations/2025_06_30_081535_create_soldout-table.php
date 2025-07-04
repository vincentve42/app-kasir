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
        Schema::create('soldouts',function(Blueprint $table){
            $table->id();
            $table->bigInteger('user_id')->references('id')->on("users")->onDelete('cascade');
            $table->bigInteger('product_id')->references('id')->on("products")->onDelete('cascade');
            $table->integer('price')->default(0);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->string('name')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
