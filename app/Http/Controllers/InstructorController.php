<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InstructorController extends Controller
{
    public function index()
    {
        return view('instructors.index', [
            'title' => __('instructors.title'),
            'instructors' => Instructor::paginate()
        ]);
    }

    public function show($computer_id)
    {
        $instructor = Instructor::where('computer_id', $computer_id)->firstOrFail();
        return view('instructors.show', [
            'title' => $instructor->name,
            'instructor' => $instructor,
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        // dd($request->all());
        abort_if(!$request->user()->is_admin, 403);

        $request->validate([
            'photo' => 'nullable|mimes:jpeg,jeg,bmp,png|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
        ]);

        $instructor = Instructor::findOrFail($request->id);

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $extension = $request->photo->extension();
                $file_name = Str::random(10).'.'.$extension;
                $request->photo->storeAs('photos', $file_name);


                $instructor->photo = $file_name;
            } else {
                return back()->with('error', __('instructors.photo-invalid'));
            }
        }

        $instructor->phone = $request->phone;
        $instructor->email = $request->email;
        $instructor->save();
        return back()->with('success', __('instructors.updated'));
    }

    public function removePhoto(Request $request)
    {
        $instructor = Instructor::findOrFail($request->id);
        Storage::disk('photos')->delete($instructor->photo);
        $instructor->photo = null;
        $instructor->save();

        return back()->with('success', __('instructors.photo-removed'));
    }
}
