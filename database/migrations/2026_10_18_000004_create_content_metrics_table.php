<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("content_metrics", function (Blueprint $table) {
            $table->id();
            $table->foreignId("content_id")->constrained()->onDelete("cascade");
            $table->unsignedBigInteger("views")->default(0);
            $table->unsignedBigInteger("likes")->default(0);
            $table->unsignedBigInteger("comments")->default(0);
            $table->unsignedBigInteger("shares")->default(0);
            $table->timestamp("recorded_at")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("content_metrics");
    }
};