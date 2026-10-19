<?php

namespace App\Http\Controllers;

use App\Models\ContentMetric;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentMetricController extends Controller
{
    public function store(Request $request, $contentId)
    {
        $content = Content::where("id", $contentId)
            ->where("user_id", $request->user()->id)
            ->firstOrFail();

        $validated = $request->validate([
            "views" => "nullable|integer|min:0",
            "likes" => "nullable|integer|min:0",
            "comments" => "nullable|integer|min:0",
            "shares" => "nullable|integer|min:0",
            "recorded_at" => "nullable|date",
        ]);

        $metric = $content->metrics()->create($validated);

        return response()->json([
            "success" => true,
            "message" => "Metrik konten berhasil dicatat",
            "data" => $metric
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $metric = ContentMetric::where("id", $id)->firstOrFail();

        if ($metric->content->user_id !== $request->user()->id) {
            abort(403, "Unauthorized");
        }

        $validated = $request->validate([
            "views" => "sometimes|integer|min:0",
            "likes" => "sometimes|integer|min:0",
            "comments" => "sometimes|integer|min:0",
            "shares" => "sometimes|integer|min:0",
            "recorded_at" => "nullable|date",
        ]);

        $metric->update($validated);

        return response()->json([
            "success" => true,
            "message" => "Metrik konten berhasil diperbarui",
            "data" => $metric
        ], 200);
    }
}