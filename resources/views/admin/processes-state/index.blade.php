@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.processesState.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('processes_state_create')
                    <a class="btn btn-indigo" href="{{ route('admin.processes-states.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.processesState.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('processes-state.index')

    </div>
</div>
@endsection