<?php

use App\Models\ShopItem;
use App\Models\ShopPhoto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::disableForeignKeyConstraints();

        ShopItem::truncate();
        ShopPhoto::truncate();

//        Schema::table('shop_items', function (Blueprint $table) {
            Schema::dropIfExists('shop_items');
//        });

        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->string('firma')->comment('фирма');
            $table->string('naimenovanie')->comment('Наименование');
            $table->string('dobavka')->nullable()->comment('Добавка');
            $table->string('kod_t')->comment('КодТ');
            $table->string('sayt_tab')->comment('сайт');
            $table->string('foto')->nullable()->comment('Фото');
            $table->integer('deb_kol_kon')->nullable()->comment('ДебКолКон');
            $table->decimal('tsena1', 10, 2)->nullable()->comment('Цена1');
            $table->decimal('tsena2', 10, 2)->nullable()->comment('Цена2');
            $table->decimal('tsena3', 10, 2)->nullable()->comment('Цена3');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('shop_items', function (Blueprint $table) {
            Schema::dropIfExists('shop_items');
//        });
    }
};
