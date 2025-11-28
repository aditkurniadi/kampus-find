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
        Schema::table('found_items', function (Blueprint $table) {
            // Kita gunakan ->nullable() karena saat barang baru dibuat, 
            // belum ada yang mengambilnya (kosong).

            $table->string('taken_by_name')->nullable()->after('status');
            $table->string('taken_by_npm')->nullable()->after('taken_by_name');
            $table->string('taken_by_phone')->nullable()->after('taken_by_npm');

            // Opsional: Tambahkan tanggal pengambilan
            $table->timestamp('taken_at')->nullable()->after('taken_by_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('found_items', function (Blueprint $table) {
            $table->dropColumn([
                'taken_by_name',
                'taken_by_npm',
                'taken_by_phone',
                'taken_at'
            ]);
        });
    }
};
