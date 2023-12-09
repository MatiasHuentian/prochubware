<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\RisksControlsMethod;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RisksControlsMethodController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('risks_controls_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-method.index');
    }

    public function create()
    {
        abort_if(Gate::denies('risks_controls_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-method.create');
    }

    public function edit(RisksControlsMethod $risksControlsMethod)
    {
        abort_if(Gate::denies('risks_controls_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-method.edit', compact('risksControlsMethod'));
    }

    public function __construct()
    {
        $this->csvImportModel = RisksControlsMethod::class;
    }
}
