<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            // 'full' = tanggal sudah penuh, 'blocked' = sengaja dikosongkan
            $table->string('type', 20)->default('full')->after('booking_date');
            $table->string('start_time', 5)->nullable()->change();

            // Data pelanggan sederhana untuk jadwal yang terisi
            $table->string('customer_name', 100)->nullable()->after('note');
            $table->string('customer_phone', 20)->nullable()->after('customer_name');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['type', 'customer_name', 'customer_phone']);
            $table->string('start_time', 5)->nullable(false)->change();
        });
    }
};
