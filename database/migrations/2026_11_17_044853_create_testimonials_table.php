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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name'); // Contoh: Nadia Putri
            $table->string('event_or_role'); // Contoh: Pengantin Akad & Resepsi, Malang
            $table->string('category_label')->nullable(); // Contoh: Pengantin Couture
            $table->text('quote'); // Isi ulasan klien
            $table->unsignedTinyInteger('rating')->default(5); // 1 - 5 bintang
            $table->string('avatar')->nullable(); // Foto klien (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
