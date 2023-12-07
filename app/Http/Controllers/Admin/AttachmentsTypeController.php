<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\AttachmentsType;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AttachmentsTypeController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('attachments_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attachments-type.index');
    }

    public function create()
    {
        abort_if(Gate::denies('attachments_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attachments-type.create');
    }

    public function edit(AttachmentsType $attachmentsType)
    {
        abort_if(Gate::denies('attachments_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attachments-type.edit', compact('attachmentsType'));
    }

    public function __construct()
    {
        $this->csvImportModel = AttachmentsType::class;
    }
}
