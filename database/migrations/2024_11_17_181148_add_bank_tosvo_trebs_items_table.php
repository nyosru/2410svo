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
        Schema::table('svo_trebs_items', function (Blueprint $table) {
            $table->string('dobavka_bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('svo_trebs_items', function (Blueprint $table) {
            $table->dropColumn([
                'dobavka_bank',
            ]);
        });
    }

};
