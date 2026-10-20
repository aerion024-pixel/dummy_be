<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("channels", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("platform");
            $table->string("channel_name");
            $table->string("channel_url");
            $table->unsignedBigInteger("subscriber_count")->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("channels");
    }
};