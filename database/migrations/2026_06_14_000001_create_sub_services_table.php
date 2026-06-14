<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_services', function (Blueprint $table) {
            $table->id();
            // Parent service this sub-service belongs to.
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            // Mirrors the services table fields.
            $table->string('code')->nullable();
            $table->json('tag')->nullable();
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->json('scope_lines')->nullable(); // {"en": [...], "ar": [...]}
            $table->json('timeline')->nullable();
            $table->json('fee_from')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_services');
    }
};
