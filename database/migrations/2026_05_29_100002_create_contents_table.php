<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('group')->default('front')->index();
            $table->string('key');
            $table->json('values')->nullable();          // {"en": "...", "ar": "..."}
            $table->string('type')->default('text');     // text | textarea | html
            $table->string('page')->nullable()->index(); // grouping for admin UI
            $table->string('section')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->unique(['group', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
