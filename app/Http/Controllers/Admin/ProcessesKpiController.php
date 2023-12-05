<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ProcessesKpi;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProcessesKpiController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('processes_kpi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-kpi.index');
    }

    public function create()
    {
        abort_if(Gate::denies('processes_kpi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-kpi.create');
    }

    public function edit(ProcessesKpi $processesKpi)
    {
        abort_if(Gate::denies('processes_kpi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-kpi.edit', compact('processesKpi'));
    }

    public function show(ProcessesKpi $processesKpi)
    {
        abort_if(Gate::denies('processes_kpi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processesKpi->load('process');

        return view('admin.processes-kpi.show', compact('processesKpi'));
    }

    public function __construct()
    {
        $this->csvImportModel = ProcessesKpi::class;
    }
}
