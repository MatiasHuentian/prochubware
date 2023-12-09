<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ActivitiesRisksPolitic;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivitiesRisksPoliticController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('activities_risks_politic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-politic.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activities_risks_politic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-politic.create');
    }

    public function edit(ActivitiesRisksPolitic $activitiesRisksPolitic)
    {
        abort_if(Gate::denies('activities_risks_politic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-politic.edit', compact('activitiesRisksPolitic'));
    }

    public function __construct()
    {
        $this->csvImportModel = ActivitiesRisksPolitic::class;
    }
}
