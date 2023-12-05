@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.attachment.title_singular') }}:
                    {{ trans('cruds.attachment.fields.id') }}
                    {{ $attachment->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.attachment.fields.id') }}
                            </th>
                            <td>
                                {{ $attachment->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.attachment.fields.process') }}
                            </th>
                            <td>
                                @if($attachment->process)
                                    <span class="badge badge-relationship">{{ $attachment->process->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.attachment.fields.category') }}
                            </th>
                            <td>
                                @if($attachment->category)
                                    <span class="badge badge-relationship">{{ $attachment->category->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.attachment.fields.src') }}
                            </th>
                            <td>
                                @foreach($attachment->src as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.attachment.fields.description') }}
                            </th>
                            <td>
                                {{ $attachment->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('attachment_edit')
                    <a href="{{ route('admin.attachments.edit', $attachment) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.attachments.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection