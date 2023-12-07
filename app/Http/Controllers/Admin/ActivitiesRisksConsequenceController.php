<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ActivitiesRisksConsequence;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivitiesRisksConsequenceController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('activities_risks_consequence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-consequence.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activities_risks_consequence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-consequence.create');
    }

    public function edit(ActivitiesRisksConsequence $activitiesRisksConsequence)
    {
        abort_if(Gate::denies('activities_risks_consequence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-consequence.edit', compact('activitiesRisksConsequence'));
    }

    public function show(ActivitiesRisksConsequence $activitiesRisksConsequence)
    {
        abort_if(Gate::denies('activities_risks_consequence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activitiesRisksConsequence->load('risk');

        return view('admin.activities-risks-consequence.show', compact('activitiesRisksConsequence'));
    }

    public function __construct()
    {
        $this->csvImportModel = ActivitiesRisksConsequence::class;
    }
}
