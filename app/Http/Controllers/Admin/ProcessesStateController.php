<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ProcessesState;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProcessesStateController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('processes_state_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-state.index');
    }

    public function create()
    {
        abort_if(Gate::denies('processes_state_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-state.create');
    }

    public function edit(ProcessesState $processesState)
    {
        abort_if(Gate::denies('processes_state_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-state.edit', compact('processesState'));
    }

    public function __construct()
    {
        $this->csvImportModel = ProcessesState::class;
    }
}
