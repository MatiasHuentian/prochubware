<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ActivitiesRisk;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivitiesRiskController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('activities_risk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risk.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activities_risk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risk.create');
    }

    public function edit(ActivitiesRisk $activitiesRisk)
    {
        abort_if(Gate::denies('activities_risk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risk.edit', compact('activitiesRisk'));
    }

    public function show(ActivitiesRisk $activitiesRisk)
    {
        abort_if(Gate::denies('activities_risk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activitiesRisk->load('activity', 'politic', 'probability', 'impact');

        return view('admin.activities-risk.show', compact('activitiesRisk'));
    }

    public function __construct()
    {
        $this->csvImportModel = ActivitiesRisk::class;
    }
}
