<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Screen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'title' => __('users.title')
        ]);
    }

    public function loadUsers()
    {
        return response()->json([
            'html' => view('users.table')->render(),
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'is_admin' => $request->has('is_admin'),
            'section' => $request->section,
            'password' => bcrypt('1234'),
        ]);

        return back()->with('success', __('users.add-user-confirmation', ['name' => $user->name]));
    }

    public function update(Request $request, User $user)
    {
        if ($request->isMethod('PATCH')) {
            $user->password = bcrypt('1234');
            $user->save();
            return response()->json([
                'message' => __('users.unlock-confirmation', ['name' => $user->name])
            ]);
        }

        if ($request->isMethod('POST')) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->is_admin = $request->has('is_admin');
            $user->section = $request->section;
            $user->save();

            return back()->with('success', __('users.update-user-confirmation', ['name' => $user->name]));

            return response()->json([
                'message' => __('users.update-user-confirmation', ['name' => $user->name]),
                'name' => $user->name,
                'username' => $user->username,
            ]);
        }
    }

    public function destroy(User $user)
    {
        abort_if(User::count() == 1, 403, __('users.only-one-message'));

        $user->delete();
        return response()->json([
            'message' => __('users.destroy-confirmation', ['name' => $user->name])
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with('success', __('users.password-confirmation-message'));
        }

        return back()->with('error', __('users.invalid-password-message'));
    }

    public function assignScreen(Request $request, User $user)
    {
        foreach ($user->screens as $screen) {
            $screen->user_id = null;
            $screen->save();
        }

        foreach ($request->screen as $key => $value) {
            $screen = Screen::find($value);
            $screen->user_id = $user->id;
            $screen->save();
        }

        return back()->with('success', __('users.screens-message'));
    }
}
