<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $announcement = null;

        if ($request->type == 'text') {
            $request->validate([
                'text' => 'required|max:255',
            ]);

            $announcement = Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $request->text,
                'is_active' => true,
                'user_id' => $request->user()->id,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
            ]);
            $announcement->screen()->update([
                'fingerprint' => Str::random(80),
            ]);
        } else {
            $announcement = $this->addContent($request);
            $announcement->screen()->update([
                'fingerprint' => Str::random(80),
            ]);
        }

        return back()->with('success', __('announcements.create'));
    }

    private function addContent(Request $request, Announcement $announcement = null) : Announcement
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
                'type' => $request->type,
                'value' => $file_name,
                'content_start' => null,
                'content_end' => null,
                'user_id' => $request->user()->id,
            ]);
        } else {
            $announcement = Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $file_name,
                'is_active' => true,
                'content_start' => null,
                'content_end' => null,
                'user_id' => $request->user()->id,
            ]);
        }

        DB::commit();

        return $announcement;
    }

    public function update(Request $request)
    {
        $announcement = Announcement::find($request->id);

        if ($request->type == 'text') {
            $announcement->update([
                'value' => $request->text,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
            ]);
            if ($announcement->is_active) {
                $announcement->screen()->update([
                    'fingerprint' => Str::random(80),
                ]);
            }
        } else {
            $this->addContent($request, $announcement);
            $announcement->screen()->update([
                'fingerprint' => Str::random(80),
            ]);
        }

        return back()->with('success', __('announcements.update'));
    }

    public function delete(Request $request)
    {
        $announcement = Announcement::find($request->delete_id);
        $announcement->screen()->update(['fingerprint' => Str::random(80)]);
        $announcement->delete();

        return back()->with('success', __('announcements.delete'));
    }

    public function changeActive(Request $request)
    {
        $announcement = Announcement::find($request->id);
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();

        // Check if all announcement are deactivated
        $announcement->screen()->update(['fingerprint' => Str::random(80)]);

        return back()->with('success', __('announcements.update'));
    }

    public function getDialog(Request $request)
    {
        $announcement = Announcement::find($request->id);
        return view('screens._dialog', ['announcement' => $announcement])->render();
    }

    public function addGlobal(Request $request)
    {
        // dd($request->all());

        // Validation
        if ($request->type == 'text') {
            $request->validate([
                'content_start' => 'required|date:H:i Y-m-d',
                'content_end' => 'required|date:H:i Y-m-d',
                'text' => 'required|max:255',
            ]);
        } else {
            $request->validate([
                'content' => $this->rules[$request->type],
            ]);
        }

        DB::transaction(function () use($request) {
            $user = $request->user();

            if ($user->is_admin) {
                $screens = Screen::all();
            } else {
                $screens = Screen::where('user_id', $user->id)->get();
            }

            foreach ($screens as $screen) {
                if ($request->type == 'text') {
                    $value = $request->text;
                } else {
                    $extension = $request->content->extension();
                    $value = Str::random(10).'.'.$extension;
                    $request->content->storeAs('content', $value);
                }

                $screen->announcements()->create([
                    'type' => $request->type,
                    'value' => $value,
                    'is_active' => true,
                    'user_id' => $user->id,
                    'content_start' => $request->content_start,
                    'content_end' => $request->content_end,
                ]);
            }
        });

        return back()->with('success', __('announcements.create'));
    }

    public function activateText(Request $request)
    {
        $announcement = Announcement::find($request->id);
        $announcement->update([
            'is_active' => true,
            'content_start' => $request->content_start,
            'content_end' => $request->content_end,
        ]);

        $announcement->screen()->update([
            'fingerprint' => Str::random(80),

        ]);

        return back()->with('success', __('announcements.update'));
    }

    public function doMassCommand(Request $request)
    {
        // dd($request->all());

        switch ($request->command) {
            case 'deactivate':
                Announcement::whereIn('id', $request->announcement)->update(['is_active' => false]);
                break;

            case 'activate':
                Announcement::whereIn('id', $request->announcement)->update(['is_active' => true]);
                break;

            case 'delete':
                Announcement::whereIn('id', $request->announcement)->delete();
                break;
        }

        return back()->with('success', __('announcements.mass_cmd_msg'));
    }
}
