<?php

namespace App\Http\Controller

use App\Models\Channel
use Illuminate\Http\Request

class ChannelController extends Controller

{
    public function index(Request $request)

    {
        $channels = Channel::where("user_id", $request -> user -> () -> id ) -> get()

    return res() -> json([
        "success" = true,
        "message" = "daftar channel berhasil dikirim",
        "data" = $channels
    ], 200)
    }
    
    public function store(Request $request)
    {
        $validated = $request -> validate([
            "platform" => "required|string|in:youtube, tiktok, instagram, twitter",
            "channel_name" => "required|string|max:255",
            "channel_url" => "required|url",
            "subcriber_count" => "nullable|integer|min:0",
        ])
        $channel= Channel::create([
            "user_id" => $request -> user() -> id,
            "platform" => $validated["platform"],
            "channel_name" => $validated["channel_name"],
            "channel_url" => $validated["channel_url"],
            "subcriber_count" => $validated["subcriber_count"] ?? 0,
        ])
        return res() -> json([
            "success"=> true,
            "message"=> "channel berhasil ditambahkan",
            "data" => $channel
        ], 201)
    }
}