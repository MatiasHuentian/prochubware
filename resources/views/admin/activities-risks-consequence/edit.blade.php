@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.activitiesRisksConsequence.title_singular') }}:
                    {{ trans('cruds.activitiesRisksConsequence.fields.id') }}
                    {{ $activitiesRisksConsequence->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('activities-risks-consequence.edit', [$activitiesRisksConsequence])
        </div>
    </div>
</div>
@endsection