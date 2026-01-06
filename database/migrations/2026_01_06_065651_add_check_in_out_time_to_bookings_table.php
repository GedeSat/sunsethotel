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
            // Menambah kolom waktu check in/out manual
            // ditaruh setelah kolom 'status' (atau 'check_out' sesuai databasemu)
            $table->dateTime('check_in_time')->nullable()->after('status'); 
            $table->dateTime('check_out_time')->nullable()->after('check_in_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['check_in_time', 'check_out_time']);
        });
    }
};