@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.activitiesRisksImpact.title_singular') }}:
                    {{ trans('cruds.activitiesRisksImpact.fields.id') }}
                    {{ $activitiesRisksImpact->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('activities-risks-impact.edit', [$activitiesRisksImpact])
        </div>
    </div>
</div>
@endsection