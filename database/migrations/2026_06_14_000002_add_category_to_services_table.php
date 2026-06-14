<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Which authority the service falls under: 'moic' (Ministry of Industry
            // & Commerce) or 'cbb' (Central Bank of Bahrain).
            $table->string('category')->default('moic')->after('code');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
