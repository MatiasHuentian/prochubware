<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Input;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InputController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('input_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.input.index');
    }

    public function create()
    {
        abort_if(Gate::denies('input_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.input.create');
    }

    public function edit(Input $input)
    {
        abort_if(Gate::denies('input_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.input.edit', compact('input'));
    }

    public function __construct()
    {
        $this->csvImportModel = Input::class;
    }
}
