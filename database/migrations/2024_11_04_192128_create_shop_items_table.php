<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Наименование');
            $table->string('additive')->nullable()->comment('Добавка');
            $table->string('code')->comment('КодТ');
            $table->string('photo')->nullable()->comment('Фото');
            $table->integer('stock_balance')->nullable()->comment('ДебКолКон');
            $table->decimal('price1', 10, 2)->nullable()->comment('Цена1');
            $table->decimal('price2', 10, 2)->nullable()->comment('Цена2');
            $table->decimal('price3', 10, 2)->nullable()->comment('Цена3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_items', function (Blueprint $table) {
            Schema::dropIfExists('shop_items');
        });
    }
};
