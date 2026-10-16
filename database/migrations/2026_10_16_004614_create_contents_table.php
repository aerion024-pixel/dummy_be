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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->consrained()->onDelete('cascade');
            $table->foreignId('channel_id')->consrained()->onDelete('cascade');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->text('script_draft')->nullable();
            $table->string('format_type', 30);//short_video, long_video, carousel, single_post
            $table->string('status', 20)->default('idea');// idea, scripting, recording, editing, ready, published
            $table->string('priority', 10)->default('medium');// low, medium, high
            $table->date('scheduled_date')->nullable();
            $table->date('published_date')->nullable();
            $table->string('published_url', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
