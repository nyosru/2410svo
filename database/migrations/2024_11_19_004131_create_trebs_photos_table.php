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
        Schema::create('trebs_photos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('svo_trebs_item_id')->constrained()->onDelete('cascade');
            $table->string('photo_url');
            $table->string('photo_loaded')->nullable(); // Добавляем новое поле

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trebs_photos');
    }
};
