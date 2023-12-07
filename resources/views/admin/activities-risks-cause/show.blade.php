@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.activitiesRisksCause.title_singular') }}:
                    {{ trans('cruds.activitiesRisksCause.fields.id') }}
                    {{ $activitiesRisksCause->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksCause.fields.id') }}
                            </th>
                            <td>
                                {{ $activitiesRisksCause->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksCause.fields.risk') }}
                            </th>
                            <td>
                                @if($activitiesRisksCause->risk)
                                    <span class="badge badge-relationship">{{ $activitiesRisksCause->risk->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksCause.fields.name') }}
                            </th>
                            <td>
                                {{ $activitiesRisksCause->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksCause.fields.description') }}
                            </th>
                            <td>
                                {{ $activitiesRisksCause->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('activities_risks_cause_edit')
                    <a href="{{ route('admin.activities-risks-causes.edit', $activitiesRisksCause) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.activities-risks-causes.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection