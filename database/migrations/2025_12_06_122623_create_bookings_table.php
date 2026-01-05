<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('total_price');
            $table->timestamps();
            $table->string('order_id')->unique();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->string('payment_type')->nullable();
            $table->timestamp('paid_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
