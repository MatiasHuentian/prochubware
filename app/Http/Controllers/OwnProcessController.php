<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OwnProcessController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('guest_process_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $datosDeUsuario = Auth::user();
        return view('guest.process.index'  , compact( 'datosDeUsuario' ));
    }
}
