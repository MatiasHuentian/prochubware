<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Output;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OutputController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('output_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.output.index');
    }

    public function create()
    {
        abort_if(Gate::denies('output_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.output.create');
    }

    public function edit(Output $output)
    {
        abort_if(Gate::denies('output_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.output.edit', compact('output'));
    }

    public function __construct()
    {
        $this->csvImportModel = Output::class;
    }
}
