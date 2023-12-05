@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.risksControl.title_singular') }}:
                    {{ trans('cruds.risksControl.fields.id') }}
                    {{ $risksControl->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.risksControl.fields.id') }}
                            </th>
                            <td>
                                {{ $risksControl->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.risksControl.fields.risk') }}
                            </th>
                            <td>
                                @if($risksControl->risk)
                                    <span class="badge badge-relationship">{{ $risksControl->risk->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.risksControl.fields.name') }}
                            </th>
                            <td>
                                {{ $risksControl->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.risksControl.fields.frecuency') }}
                            </th>
                            <td>
                                @if($risksControl->frecuency)
                                    <span class="badge badge-relationship">{{ $risksControl->frecuency->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.risksControl.fields.method') }}
                            </th>
                            <td>
                                @if($risksControl->method)
                                    <span class="badge badge-relationship">{{ $risksControl->method->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.risksControl.fields.type') }}
                            </th>
                            <td>
                                @if($risksControl->type)
                                    <span class="badge badge-relationship">{{ $risksControl->type->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('risks_control_edit')
                    <a href="{{ route('admin.risks-controls.edit', $risksControl) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.risks-controls.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection