@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.risksControlsFrecuency.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('risks_controls_frecuency_create')
                    <a class="btn btn-indigo" href="{{ route('admin.risks-controls-frecuencies.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.risksControlsFrecuency.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('risks-controls-frecuency.index')

    </div>
</div>
@endsection