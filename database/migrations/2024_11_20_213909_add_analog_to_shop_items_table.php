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
        Schema::table('shop_items', function (Blueprint $table) {
            $table->string('analog')->nullable(); // Укажите имя существующего столбца, после которого нужно добавить поле

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_items', function (Blueprint $table) {
            $table->dropColumn('analog');
        });
    }
};
