@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.activitiesRisksProbability.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('activities_risks_probability_create')
                    <a class="btn btn-indigo" href="{{ route('admin.activities-risks-probabilities.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.activitiesRisksProbability.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('activities-risks-probability.index')

    </div>
</div>
@endsection