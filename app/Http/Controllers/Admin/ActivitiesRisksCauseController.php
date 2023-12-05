<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ActivitiesRisksCause;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivitiesRisksCauseController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('activities_risks_cause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-cause.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activities_risks_cause_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-cause.create');
    }

    public function edit(ActivitiesRisksCause $activitiesRisksCause)
    {
        abort_if(Gate::denies('activities_risks_cause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-cause.edit', compact('activitiesRisksCause'));
    }

    public function show(ActivitiesRisksCause $activitiesRisksCause)
    {
        abort_if(Gate::denies('activities_risks_cause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activitiesRisksCause->load('risk');

        return view('admin.activities-risks-cause.show', compact('activitiesRisksCause'));
    }

    public function __construct()
    {
        $this->csvImportModel = ActivitiesRisksCause::class;
    }
}
