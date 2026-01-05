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
        Schema::table('bookings', function (Blueprint $table) {
            // Menambahkan kolom baru
            // 'after' digunakan untuk mengatur posisi kolom (opsional, biar rapi di DB)
            // 'nullable' berarti kolom ini boleh kosong (aman untuk data lama)
            
            $table->string('name')->nullable()->after('user_id'); 
            $table->string('email')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Hapus kolom jika migration di-rollback
            $table->dropColumn(['name', 'email', 'phone']);
        });
    }
};