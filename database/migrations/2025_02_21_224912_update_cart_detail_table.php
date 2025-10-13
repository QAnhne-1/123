<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cart_detail', function(Blueprint $table) {
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
            $table->integer('quantity')->default('1');
        });
    }

    public function down(): void
    {
        Schema::table('cart_detail', function(Blueprint $table) {
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
            $table->integer('quantity')->default('1');
        });
    }
};
