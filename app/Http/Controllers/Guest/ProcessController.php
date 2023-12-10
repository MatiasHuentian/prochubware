<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ProcessController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('guest_process_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('guest.process.index');
    }
}
