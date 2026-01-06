<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Kita paksa ubah kolom jadi VARCHAR (String) menggunakan Raw SQL
        // Ini cara paling ampuh mengatasi error enum tanpa doctrine/dbal
        DB::statement("ALTER TABLE bookings MODIFY COLUMN payment_status VARCHAR(191) NOT NULL DEFAULT 'unpaid'");
        
        // Sekalian jaga-jaga untuk kolom status biar gak error berikutnya
        // Karena di query kamu ada status 'booked'
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status VARCHAR(191) NOT NULL DEFAULT 'booked'");
    }

    public function down(): void
    {
        // Kembalikan ke Enum jika di-rollback (Opsional)
        // DB::statement("ALTER TABLE bookings MODIFY COLUMN payment_status ENUM('pending','paid','failed') DEFAULT 'pending'");
    }
};