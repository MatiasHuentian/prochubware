<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class HomeController
{
    public function index()
    {
        abort_if(Gate::denies('admin_panel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.home');
    }
}
