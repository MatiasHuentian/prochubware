<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\RisksControlsType;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RisksControlsTypeController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('risks_controls_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-type.index');
    }

    public function create()
    {
        abort_if(Gate::denies('risks_controls_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-type.create');
    }

    public function edit(RisksControlsType $risksControlsType)
    {
        abort_if(Gate::denies('risks_controls_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-type.edit', compact('risksControlsType'));
    }

    public function __construct()
    {
        $this->csvImportModel = RisksControlsType::class;
    }
}
