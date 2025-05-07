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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên người đặt vé
            $table->string('email'); // Email người đặt vé
            $table->string('phone'); // Số điện thoại người đặt vé
            $table->date('visit_date'); // Ngày tham quan
            $table->integer('quantity'); // Số lượng vé
            $table->decimal('price', 10, 2); // Giá vé (có thể khác nhau cho từng ngày)
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'paid'])->default('pending'); // Trạng thái vé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
