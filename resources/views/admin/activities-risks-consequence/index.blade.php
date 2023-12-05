@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.activitiesRisksConsequence.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('activities_risks_consequence_create')
                    <a class="btn btn-indigo" href="{{ route('admin.activities-risks-consequences.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.activitiesRisksConsequence.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('activities-risks-consequence.index')

    </div>
</div>
@endsection