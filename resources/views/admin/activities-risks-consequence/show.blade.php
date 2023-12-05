@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.activitiesRisksConsequence.title_singular') }}:
                    {{ trans('cruds.activitiesRisksConsequence.fields.id') }}
                    {{ $activitiesRisksConsequence->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksConsequence.fields.id') }}
                            </th>
                            <td>
                                {{ $activitiesRisksConsequence->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksConsequence.fields.risk') }}
                            </th>
                            <td>
                                @if($activitiesRisksConsequence->risk)
                                    <span class="badge badge-relationship">{{ $activitiesRisksConsequence->risk->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksConsequence.fields.name') }}
                            </th>
                            <td>
                                {{ $activitiesRisksConsequence->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.activitiesRisksConsequence.fields.description') }}
                            </th>
                            <td>
                                {{ $activitiesRisksConsequence->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('activities_risks_consequence_edit')
                    <a href="{{ route('admin.activities-risks-consequences.edit', $activitiesRisksConsequence) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.activities-risks-consequences.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection