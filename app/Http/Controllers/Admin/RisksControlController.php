<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\RisksControl;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RisksControlController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('risks_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-control.index');
    }

    public function create()
    {
        abort_if(Gate::denies('risks_control_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-control.create');
    }

    public function edit(RisksControl $risksControl)
    {
        abort_if(Gate::denies('risks_control_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-control.edit', compact('risksControl'));
    }

    public function show(RisksControl $risksControl)
    {
        abort_if(Gate::denies('risks_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $risksControl->load('risk', 'frecuency', 'method', 'type');

        return view('admin.risks-control.show', compact('risksControl'));
    }

    public function __construct()
    {
        $this->csvImportModel = RisksControl::class;
    }
}
