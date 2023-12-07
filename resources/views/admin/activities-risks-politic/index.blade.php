@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.activitiesRisksPolitic.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('activities_risks_politic_create')
                    <a class="btn btn-indigo" href="{{ route('admin.activities-risks-politics.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.activitiesRisksPolitic.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('activities-risks-politic.index')

    </div>
</div>
@endsection