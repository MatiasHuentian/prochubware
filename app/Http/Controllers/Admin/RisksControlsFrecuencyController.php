<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\RisksControlsFrecuency;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RisksControlsFrecuencyController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('risks_controls_frecuency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-frecuency.index');
    }

    public function create()
    {
        abort_if(Gate::denies('risks_controls_frecuency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-frecuency.create');
    }

    public function edit(RisksControlsFrecuency $risksControlsFrecuency)
    {
        abort_if(Gate::denies('risks_controls_frecuency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.risks-controls-frecuency.edit', compact('risksControlsFrecuency'));
    }

    public function __construct()
    {
        $this->csvImportModel = RisksControlsFrecuency::class;
    }
}
