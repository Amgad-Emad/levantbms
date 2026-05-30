<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('path')->index();
            $table->string('route_name')->nullable();
            $table->string('locale', 8)->nullable();
            $table->string('referrer')->nullable();
            $table->string('session_id')->nullable();
            $table->string('ip_hash')->nullable();
            $table->string('device', 16)->nullable(); // mobile | desktop | tablet
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
