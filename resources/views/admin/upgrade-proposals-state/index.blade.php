@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.upgradeProposalsState.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('upgrade_proposals_state_create')
                    <a class="btn btn-indigo" href="{{ route('admin.upgrade-proposals-states.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.upgradeProposalsState.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('upgrade-proposals-state.index')

    </div>
</div>
@endsection