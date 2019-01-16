<?php

namespace App\Http\Controllers;

class MyLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        return response()->json([
            'user' => $user->id,
            'token' => $request->session()->token(),
        ]);
    }
}
