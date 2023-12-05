@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.processesKpi.title_singular') }}:
                    {{ trans('cruds.processesKpi.fields.id') }}
                    {{ $processesKpi->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.processesKpi.fields.id') }}
                            </th>
                            <td>
                                {{ $processesKpi->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesKpi.fields.process') }}
                            </th>
                            <td>
                                @if($processesKpi->process)
                                    <span class="badge badge-relationship">{{ $processesKpi->process->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesKpi.fields.name') }}
                            </th>
                            <td>
                                {{ $processesKpi->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesKpi.fields.description') }}
                            </th>
                            <td>
                                {{ $processesKpi->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('processes_kpi_edit')
                    <a href="{{ route('admin.processes-kpis.edit', $processesKpi) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.processes-kpis.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection