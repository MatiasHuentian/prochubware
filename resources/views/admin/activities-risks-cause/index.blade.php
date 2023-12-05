@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.activitiesRisksCause.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('activities_risks_cause_create')
                    <a class="btn btn-indigo" href="{{ route('admin.activities-risks-causes.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.activitiesRisksCause.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('activities-risks-cause.index')

    </div>
</div>
@endsection