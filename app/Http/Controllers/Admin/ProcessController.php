<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Process;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProcessController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('process_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.process.index');
    }

    public function create()
    {
        abort_if(Gate::denies('process_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.process.create');
    }

    public function edit(Process $process)
    {
        abort_if(Gate::denies('process_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.process.edit', compact('process'));
    }

    public function show(Process $process)
    {
        abort_if(Gate::denies('process_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $process->load('owner', 'dependency', 'state', 'glosary', 'input', 'output', 'objectiveGroup');

        return view('admin.process.show', compact('process'));
    }

    public function pdfexport(Process $process)
    {
        $process->load('owner', 'dependency', 'state', 'glosary', 'input', 'output', 'objectiveGroup');

        $pdf = PDF::loadView('admin.process.pdf', compact('process'));
        return $pdf->stream();

        return view('admin.process.pdf_with_head', compact('process'));
    }

    public function __construct()
    {
        $this->csvImportModel = Process::class;
    }
}
