<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ActivitiesRisksProbability;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivitiesRisksProbabilityController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('activities_risks_probability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-probability.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activities_risks_probability_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-probability.create');
    }

    public function edit(ActivitiesRisksProbability $activitiesRisksProbability)
    {
        abort_if(Gate::denies('activities_risks_probability_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-probability.edit', compact('activitiesRisksProbability'));
    }

    public function __construct()
    {
        $this->csvImportModel = ActivitiesRisksProbability::class;
    }
}
