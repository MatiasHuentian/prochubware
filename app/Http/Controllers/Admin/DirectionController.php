<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Direction;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DirectionController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('direction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.direction.index');
    }

    public function create()
    {
        abort_if(Gate::denies('direction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.direction.create');
    }

    public function edit(Direction $direction)
    {
        abort_if(Gate::denies('direction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.direction.edit', compact('direction'));
    }

    public function __construct()
    {
        $this->csvImportModel = Direction::class;
    }
}
