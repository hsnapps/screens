<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    protected $rules = [
        'photo' => 'required|mimes:jpeg,jeg,bmp,png|max:2048',
        'video' => 'required|mimes:vid,mp4,mkv|max:20480',
        'pdf' => 'required|mimes:pdf|max:2048',
    ];

    public function create(Request $request)
    {
        if ($request->type == 'text') {
            Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $request->text,
                'is_active' => true,
                // 'begin' => $request->begin,
                // 'end' => $request->end,
            ]);
        } else {
            $this->addContent($request);
        }

        return back()->with('success', __('announcements.create'));

    }

    private function addContent(Request $request, Announcement $announcement = null)
    {
        $request->validate([
            'content' => $this->rules[$request->type],
        ]);

        DB::beginTransaction();

        $extension = $request->content->extension();
        $file_name = Str::random(10).'.'.$extension;
        $request->content->storeAs('content', $file_name);

        if (isset($announcement)) {
            Storage::disk('content')->delete($announcement->value);
            $announcement->update([
                // 'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $file_name,
                // 'is_active' => true,
                // 'begin' => $request->begin,
                // 'end' => $request->end,
            ]);
        } else {
            Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $file_name,
                'is_active' => true,
                // 'begin' => $request->begin,
                // 'end' => $request->end,
            ]);
        }

        DB::commit();
    }

    public function update(Request $request)
    {
        $announcement = Announcement::find($request->id);
        $announcement->begin = Carbon::parse($request->begin, 'Asia/Riyadh');
        $announcement->end = Carbon::parse($request->end, 'Asia/Riyadh');

        if ($request->type == 'text') {
            $announcement->value = $request->text;
            $announcement->save();
        } else {
            $this->addContent($request, $announcement);
        }

        return back()->with('success', __('announcements.update'));
    }

    public function delete(Request $request)
    {
        $announcement = Announcement::find($request->delete_id);
        $announcement->delete();

        return back()->with('success', __('announcements.delete'));
    }

    public function changeActive(Request $request)
    {
        $announcement = Announcement::find($request->id);
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();

        return back()->with('success', __('announcements.update'));
    }

    public function getDialog(Request $request)
    {
        $announcement = Announcement::find($request->id);
        return view('screens._dialog', ['announcement' => $announcement])->render();
    }
}
