<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_images', function (Blueprint $table) {
            $table->id();
            $table->string('page')->index();  // home, about, …
            $table->string('slot');           // harbour, md_portrait, …
            $table->timestamps();

            $table->unique(['page', 'slot']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_images');
    }
};
