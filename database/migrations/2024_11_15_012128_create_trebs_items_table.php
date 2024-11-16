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
        Schema::create('svo_trebs_items', function (Blueprint $table) {
            $table->id();

            $table->string('firma')->comment('');
            $table->string('zateya')->comment('')
                ->nullable()
            ;
//            $table->string('mol')->comment('')
//                ->nullable()
//            ;
            $table->string('mol_name')->comment('')
                ->nullable()
            ;
            $table->string('mol_link')->comment('')
                ->nullable()
            ;
            $table->string('mol_phone')->comment('')
                ->nullable()
            ;
            $table->string('doc')->comment('')
                ->nullable()
            ;
            $table->string('nom_str')->comment('')
                ->nullable()
            ;
            $table->string('name')->comment('')
                ->nullable()
            ;
            $table->string('dops')->comment('')
                ->nullable()
            ;
            $table->string('comment')->comment('')
                ->nullable()
            ;
            $table->string('curica')->comment('')
                ->nullable()
            ;
            $table->string('site_tab')->comment('')
                ->nullable()
            ;
            $table->string('photo')->comment('')
                ->nullable()
            ;

            $table->decimal('debet_kon', 10, 2)->nullable()
                ->comment('ДебетКон');
            $table->decimal('kredit_kon', 10, 2)->nullable()
                ->comment('КредитКон')
            ;
            $table->decimal('debet_kol_kon', 10, 2)->nullable()
                ->comment('ДебетКолКон')
            ;
            $table->decimal('kredit_kol_kon', 10, 2)->nullable()
                ->comment('КредитКолКон')
            ;
            $table->integer('uroven')->nullable()
                ->comment('Уровень')
            ;
            $table->integer('up_id')->nullable()
                ->comment('верхний Уровень')
            ;

//            $table->string('name')->comment('');
//            $table->string('name')->comment('Наименование');
//            $table->string('additive')->nullable()->comment('Добавка');
//            $table->string('code')->comment('КодТ');
//            $table->string('photo')->nullable()->comment('Фото');
//            $table->integer('stock_balance')->nullable()->comment('ДебКолКон');
//            $table->decimal('price1', 10, 2)->nullable()->comment('Цена1');
//            $table->decimal('price2', 10, 2)->nullable()->comment('Цена2');
//            $table->decimal('price3', 10, 2)->nullable()->comment('Цена3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('svo_trebs_items');
    }
};
