<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Attachment;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AttachmentController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('attachment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attachment.index');
    }

    public function create()
    {
        abort_if(Gate::denies('attachment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attachment.create');
    }

    public function edit(Attachment $attachment)
    {
        abort_if(Gate::denies('attachment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attachment.edit', compact('attachment'));
    }

    public function show(Attachment $attachment)
    {
        abort_if(Gate::denies('attachment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attachment->load('process', 'category');

        return view('admin.attachment.show', compact('attachment'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['attachment_create', 'attachment_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new Attachment();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }

    public function __construct()
    {
        $this->csvImportModel = Attachment::class;
    }
}
