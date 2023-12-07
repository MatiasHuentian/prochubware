@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.processesActivity.title_singular') }}:
                    {{ trans('cruds.processesActivity.fields.id') }}
                    {{ $processesActivity->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.processesActivity.fields.id') }}
                            </th>
                            <td>
                                {{ $processesActivity->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesActivity.fields.name') }}
                            </th>
                            <td>
                                {{ $processesActivity->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesActivity.fields.process') }}
                            </th>
                            <td>
                                @if($processesActivity->process)
                                    <span class="badge badge-relationship">{{ $processesActivity->process->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('processes_activity_edit')
                    <a href="{{ route('admin.processes-activities.edit', $processesActivity) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.processes-activities.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection