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
        Schema::create('found_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('location_found');
            $table->date('date_found');
            $table->string('image')->nullable(); // Dibuat nullable() sesuai skema

            // Menentukan status dengan nilai default 'available'
            $table->enum('status', ['available', 'selesai', 'pending'])->default('available');

            // Relasi ke tabel users
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // Jika user dihapus, item ini juga terhapus

            // Relasi ke tabel categories
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade'); // Jika kategori dihapus, item ini juga terhapus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_items');
    }
};
