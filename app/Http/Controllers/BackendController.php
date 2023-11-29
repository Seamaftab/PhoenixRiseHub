<?php

namespace App\Http\Controllers;

class BackendController extends Controller
{
    public function dashboard()
    {
        $this->authorize('view_users');

        return view('dashboard');
    }
}
