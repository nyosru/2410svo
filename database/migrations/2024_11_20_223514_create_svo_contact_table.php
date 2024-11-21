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
        Schema::create('svo_contact', function (Blueprint $table) {
            $table->id();

//            0 => "firma"
//    1 => "gruppa"
//    2 => "m_o_l"
//    3 => "telefon"
//    4 => "yur_adres"
//    5 => "mylo"
//    6 => "sayt_tab"
//    7 => "foto"

            $table->string('firma')->nullable();      // Фирма
            $table->string('gruppa')->nullable();     // Группа
            $table->string('m_o_l')->nullable();        // МОЛ
            $table->string('telefon')->nullable();    // Телефон
            $table->string('yur_adres')->nullable();  // ЮрАдрес
            $table->text('mylo')->nullable();       // Мыло
            $table->string('sayt_tab')->nullable();    // СайтТаб
            $table->string('foto')->nullable();       // Фото
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('svo_contact');
    }
};
