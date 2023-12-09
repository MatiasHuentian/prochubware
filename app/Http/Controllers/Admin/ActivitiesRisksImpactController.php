<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ActivitiesRisksImpact;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivitiesRisksImpactController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('activities_risks_impact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-impact.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activities_risks_impact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-impact.create');
    }

    public function edit(ActivitiesRisksImpact $activitiesRisksImpact)
    {
        abort_if(Gate::denies('activities_risks_impact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.activities-risks-impact.edit', compact('activitiesRisksImpact'));
    }

    public function __construct()
    {
        $this->csvImportModel = ActivitiesRisksImpact::class;
    }
}
