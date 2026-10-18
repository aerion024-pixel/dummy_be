<?php

use Illuminate\Database\Migrations\Migration
use Illuminate\Database\Schema\Blueprint
use Illuminate\Support\Facades\Schema

return new class Migration
{
    public function up() void
    {
        Schema::create("contents", function (Blueprint $table){
            $table -> id()
            $table -> foreignId("channel_id") -> constrained() -> onDelete("cascade")
            $table -> string("title")
            $table -> text("description") -> nullable()
            $table -> string("content_url")
            $table -> enum("status", ["draft", "scheduled", "published"]) -> default("draft")
            $table -> timestamp("published_at") -> nullable()
            $table -> timestamp()

        })

        lic function down(): void

        Schema::dropIfExits("contents")
    }
}