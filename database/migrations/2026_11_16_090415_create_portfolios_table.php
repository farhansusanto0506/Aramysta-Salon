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
    Schema::create('portfolios', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('category');
        $table->string('category_label');
        $table->string('location_or_event')->nullable();
        $table->text('description')->nullable();
        $table->string('image');
        $table->string('tags')->nullable();
        $table->boolean('is_featured')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
