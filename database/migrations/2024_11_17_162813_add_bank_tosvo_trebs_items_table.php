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
        Schema::table('svo_trebs_items', function (Blueprint $table) {
            $table->string('analog')->nullable();
            $table->string('poluchatel')->nullable();
            $table->unsignedBigInteger('i_n_n')->nullable();
            $table->unsignedBigInteger('k_p_p')->nullable();
            $table->unsignedBigInteger('rschet')->nullable();
            $table->string('bank')->nullable();
            $table->unsignedBigInteger('b_i_k')->nullable();
            $table->string('kor_schet')->nullable();
            $table->string('adres_banka')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('svo_trebs_items', function (Blueprint $table) {
            $table->dropColumn([
                'analog',
                'poluchatel',
                'i_n_n',
                'k_p_p',
                'rschet',
                'bank',
                'b_i_k',
                'kor_schet',
                'adres_banka',
            ]);
        });
    }
};
