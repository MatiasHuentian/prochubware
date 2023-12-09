<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ObejctivesGroup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ObejctivesGroupController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('obejctives_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.obejctives-group.index');
    }

    public function create()
    {
        abort_if(Gate::denies('obejctives_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.obejctives-group.create');
    }

    public function edit(ObejctivesGroup $obejctivesGroup)
    {
        abort_if(Gate::denies('obejctives_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.obejctives-group.edit', compact('obejctivesGroup'));
    }

    public function __construct()
    {
        $this->csvImportModel = ObejctivesGroup::class;
    }
}
