<?php

namespace App\Http\Controllers;

use App\Models\ContentChecklist;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentChecklistController extends Controller
{
    public function store(Request $request, $contentId)
    {
        $content = Content::where("id", $contentId)
            ->where("user_id", $request->user()->id)
            ->firstOrFail();

        $validated = $request->validate([
            "task_name" => "required|string|max:255",
            "is_completed" => "boolean",
        ]);

        $checklist = $content->checklists()->create($validated);

        return response()->json([
            "success" => true,
            "message" => "Checklist berhasil ditambahkan",
            "data" => $checklist
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $checklist = ContentChecklist::where("id", $id)->firstOrFail();

        // Validasi kepemilikan melalui relasi content -> user
        if ($checklist->content->user_id !== $request->user()->id) {
            abort(403, "Unauthorized");
        }

        $validated = $request->validate([
            "task_name" => "sometimes|string|max:255",
            "is_completed" => "sometimes|boolean",
        ]);

        $checklist->update($validated);

        return response()->json([
            "success" => true,
            "message" => "Checklist berhasil diperbarui",
            "data" => $checklist
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $checklist = ContentChecklist::where("id", $id)->firstOrFail();

        if ($checklist->content->user_id !== $request->user()->id) {
            abort(403, "Unauthorized");
        }

        $checklist->delete();

        return response()->json([
            "success" => true,
            "message" => "Checklist berhasil dihapus"
        ], 200);
    }
}