<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Channel;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::where("user_id", $request->user()->id)->with(["channel", "checklist", "metrics"]);

        if ($request->has("channel_id")) {
            $query->where("channel_id", $request->channel_id);
        }

        $contents = $query->latest()->get();

        return response()->json([
            "success" => true,
            "message" => "Daftar konten berhasil diambil",
            "data"    => $contents
        ], 200);    
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "channel_id"   => "required|exists:channels,id",
            "title"        => "required|string|max:255",
            "description"  => "nullable|string",
            "content_url"  => "nullable|url",
            "status"       => "nullable|string",
            "published_at" => "nullable|date",
        ]);
        
        $validated["user_id"] = $request->user()->id;

        $content = Content::create($validated);
        $content->load(["channel", "checklist", "metrics"]);

        return response()->json([
            "success" => true,
            "message" => "Konten berhasil dibuat",
            "data"    => $content
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $content = Content::where("id", $id)
            ->where("user_id", $request->user()->id)
            ->with(["channel", "checklist", "metrics"])
            ->firstOrFail();

        return response()->json([
            "success" => true,
            "message" => "Detail konten berhasil diambil",
            "data"    => $content 
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $content = Content::where("id", $id)
            ->where("user_id", $request->user()->id)
            ->firstOrFail();

        $validated = $request->validate([
            "channel_id"   => "sometimes|exists:channels,id",
            "title"        => "sometimes|string|max:255",
            "description"  => "nullable|string",
            "content_url"  => "nullable|url",
            "status"       => "nullable|string",
            "published_at" => "nullable|date",
        ]);

        $content->update($validated);

        return response()->json([
            "success" => true,
            "message" => "Konten berhasil diperbaharui",
            "data"    => $content->fresh(["channel", "checklist", "metrics"])
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $content = Content::where("id", $id)
            ->where("user_id", $request->user()->id)
            ->firstOrFail();

        $content->delete();

        return response()->json([ 
            "success" => true,
            "message" => "Konten berhasil dihapus"
        ], 200);
    }
}