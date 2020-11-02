<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function list($screen_id)
    {
        $announcements = Announcement::where('screen_id', $screen_id)->get();

    }

    public function create(Request $request)
    {
        if ($request->type == 'text') {
            Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $request->text,
                'is_active' => true,
            ]);
        } else {
            $rules = [
                'photo' => 'required|mimes:jpeg,jeg,bmp,png|max:2048',
                'video' => 'required|mimes:vid,mp4,mkv|max:20480',
                'pdf' => 'required|mimes:pdf|max:2048',
            ];

            $request->validate([
                'content' => $rules[$request->type],
            ]);

            DB::beginTransaction();

            $extension = $request->content->extension();
            $file_name = Str::random(10).'.'.$extension;
            $request->content->storeAs('content', $file_name);

            Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $file_name,
                'is_active' => true,
            ]);

            DB::commit();
        }

        return back()->with('success', __('announcements.create'));

    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
