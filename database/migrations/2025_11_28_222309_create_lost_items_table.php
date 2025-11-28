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
        Schema::create('lost_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('item_name');
            // Pastikan nama tabel kategori Anda 'categories'
            $table->foreignId('category_id')->constrained('categories');
            $table->text('description');
            $table->string('location');
            $table->string('image_path')->nullable();
            $table->enum('status', ['dicari', 'ditemukan', 'dibatalkan'])->default('dicari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};
