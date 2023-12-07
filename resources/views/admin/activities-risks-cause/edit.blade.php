@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.activitiesRisksCause.title_singular') }}:
                    {{ trans('cruds.activitiesRisksCause.fields.id') }}
                    {{ $activitiesRisksCause->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('activities-risks-cause.edit', [$activitiesRisksCause])
        </div>
    </div>
</div>
@endsection