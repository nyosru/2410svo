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
        Schema::create('fin_reports', function (Blueprint $table) {
            $table->id();

            $table->string('vid')->nullable();
            $table->string('firma')->nullable();
            $table->string('nom_schet')->nullable();
            $table->string('naim_schet')->nullable();
            $table->string('zateya')->nullable();
            $table->string('m_o_l')->nullable();
            $table->string('znachenie_dok')->nullable();
            $table->string('nom_str')->nullable();
            $table->string('naimenovanie')->nullable();
            $table->string('dobavka')->nullable();
            $table->text('koment')->nullable();
            $table->string('dvizh')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('debet_nach', 15, 2)->nullable();
            $table->decimal('kredit_nach', 15, 2)->nullable();
            $table->decimal('debet', 15, 2)->nullable();
            $table->decimal('kredit', 15, 2)->nullable();
            $table->decimal('debet_kon', 15, 2)->nullable();
            $table->decimal('kredit_kon', 15, 2)->nullable();
            $table->decimal('deb_kol_nach', 15, 2)->nullable();
            $table->decimal('kred_kol_nach', 15, 2)->nullable();
            $table->decimal('deb_kol', 15, 2)->nullable();
            $table->decimal('kred_kol', 15, 2)->nullable();
            $table->decimal('deb_kol_kon', 15, 2)->nullable();
            $table->decimal('kred_kol_kon', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fin_reports');
    }
};
