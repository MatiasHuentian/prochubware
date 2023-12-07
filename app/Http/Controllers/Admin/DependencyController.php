<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Dependency;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DependencyController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('dependency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dependency.index');
    }

    public function create()
    {
        abort_if(Gate::denies('dependency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dependency.create');
    }

    public function edit(Dependency $dependency)
    {
        abort_if(Gate::denies('dependency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dependency.edit', compact('dependency'));
    }

    public function __construct()
    {
        $this->csvImportModel = Dependency::class;
    }
}
