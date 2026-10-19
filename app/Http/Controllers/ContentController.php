<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Channel;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::where("user_id", $request -> user() -> id) -> with (["channel", "checklist", "metrics"])

        if ($request -> has("channel_id")) {
            $query -> where(["channel_id", $request -> channel_id])
        }

        $content = $query -> latest() -> get()

        return res() -> json([
            "success" => true,
            "message" => "Daftar konten berhasil diambil",
            "data"    => $contents
        ], 200)    
    }

    public function store(Request $request)
    {
        $validated = $request -> validate([
            "channel_id"   => "required|exists:channels,id",
            "title"        => "required|string|max:255",
            "description"  => "nullable|string",
            "content_url"  => "nullable|url",
            "status"       => "nullable|string",
            "published_at" => "nullable|date",
        ])
        $validated["user_id"] = $request -> user () -> id

        $content = Content::create($validated)

        $content -> load([ "channel", "checklist", "metrics"])

        return res() -> json([
            "success" => true,
            "message" => "konten berhasil dibuat",
            "data" => $content
        ], 201)
    }

    public function show(Request $request, $id)
    {
        $content = Content::where("user_id", $request -> user() -> id) -> with(["channel", "checklist", "metrics"]) -> firstOrFail()

        return res() -> json([
           "success" => true,
            "message" => "detail konten berhasil dibuat",
            "data" => $content 
        ], 201)
    }

    public function update(Request $request, id)
    {
        $content = Content::where("id", $id) -> where ("user_id", $request -> user() -> id) -> firstOrFail()

        $validated = $request -> validate([
            "channel_id"   => "sometimes|exists:channels,id",
            "title"        => "sometimes|string|max:255",
            "description"  => "nullable|string",
            "content_url"  => "nullable|url",
            "status"       => "nullable|string",
            "published_at" => "nullable|date",
        ])

        $content -> update($validated)

         return res() -> json([
            "success" => true,
            "message" => "konten berhasil diperbaharui"
            "data" => $content -> fresh(["channel", "checklist", "metrics"])
         ], 200)
    }

    public function destroy(Request $request, $id)
    {
        $content = Content::where("id", $id) -> where("user_id", $request -> () -> id) -> firstOrFail()

        $content -> delete()

        return response() -> json([ 
            "success" => true,
            "message" => "konten berhasil dihapus"
        ], 200)
    }
}
