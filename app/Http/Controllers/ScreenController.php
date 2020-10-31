<?php

namespace App\Http\Controllers;

use App\Screen;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Screen $screen = null)
    {
        if (isset($id)) {

        }

        return view('screens.index', [
            'title' => __('screens.title'),
        ]);
    }

    public function show(Screen $screen)
    {
        return view('screens.show', [
            'title' => __('screens.screen', ['number' => $screen->id]),
            'screen' => $screen,
        ]);
    }
}
