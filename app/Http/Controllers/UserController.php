<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.index', [
            'title' => __('app.users.title')
        ]);
    }

    public function loadUsers()
    {
        return response()->json([
            'html' => view('users.table')->render(),
        ]);
    }

    public function store(Request $request)
    {
        logger($request);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt('1234'),
        ]);

        return back()->with('success', __('app.users.add-user-confirmation', ['name' => $user->name]));

        // return response()->json([
        //     'message' => __('app.users.add-user-confirmation', ['name' => $user->name])
        // ]);
    }

    public function update(Request $request, User $user)
    {
        if ($request->isMethod('PATCH')) {
            $user->password = bcrypt('1234');
            $user->save();
            return response()->json([
                'message' => __('app.users.unlock-confirmation', ['name' => $user->name])
            ]);
        }

        if ($request->isMethod('PUT')) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();

            return response()->json([
                'message' => __('app.users.update-user-confirmation', ['name' => $user->name]),
                'name' => $user->name,
                'username' => $user->username,
            ]);

            return $user->toJson();
        }

    }

    public function destroy(User $user)
    {
        abort_if(User::count() == 1, 403, __('app.users.only-one-message'));

        $user->delete();
        return response()->json([
            'message' => __('app.users.destroy-confirmation', ['name' => $user->name])
        ]);
    }
}
