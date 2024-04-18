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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('writer');
            $table->unsignedBigInteger('categoryId'); // Tambahkan kolom categoryId
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->string('publisher');
            $table->string('year');
            $table->string('cover');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
