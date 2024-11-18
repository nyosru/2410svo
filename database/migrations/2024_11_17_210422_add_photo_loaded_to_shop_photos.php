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
        Schema::table('shop_photos', function (Blueprint $table) {
            $table->string('photo_loaded')->nullable()->after('photo_url'); // Добавляем новое поле
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_photos', function (Blueprint $table) {
            $table->dropColumn('photo_loaded'); // Удаляем поле при откате миграции
        });
    }
};
