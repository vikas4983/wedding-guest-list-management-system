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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->unique()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('image')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('location')->nullable();;
            $table->text('address');
            $table->text('description')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('rsvp_link')->nullable();
            $table->tinyInteger('is_active');
            $table->longText('html');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
