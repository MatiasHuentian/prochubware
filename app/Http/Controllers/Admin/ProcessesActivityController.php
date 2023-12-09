<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ProcessesActivity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProcessesActivityController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('processes_activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-activity.index');
    }

    public function create()
    {
        abort_if(Gate::denies('processes_activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-activity.create');
    }

    public function edit(ProcessesActivity $processesActivity)
    {
        abort_if(Gate::denies('processes_activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-activity.edit', compact('processesActivity'));
    }

    public function show(ProcessesActivity $processesActivity)
    {
        abort_if(Gate::denies('processes_activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processesActivity->load('process');

        return view('admin.processes-activity.show', compact('processesActivity'));
    }

    public function __construct()
    {
        $this->csvImportModel = ProcessesActivity::class;
    }
}
