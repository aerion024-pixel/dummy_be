<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("content_checklist", function (Blueprint $table){
            $table->id();
            $table->foreignId("content_id")->constrained()->onDelete("cascade");
            $table->string("task_name");
            $table->boolean("is_completed")->default(false);
            $table->timestamps();
        })
    }

    public function down(): void
    {
        Schema::dropIfExits("content_checklist")
    }
}
