<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_add_gallery_to_rooms_table.php
public function up()
{
    Schema::table('rooms', function (Blueprint $table) {
        $table->json('gallery')->nullable()->after('image');
    });
}

};
