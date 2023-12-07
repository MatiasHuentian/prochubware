@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.upgradeProposalsState.title_singular') }}:
                    {{ trans('cruds.upgradeProposalsState.fields.id') }}
                    {{ $upgradeProposalsState->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('upgrade-proposals-state.edit', [$upgradeProposalsState])
        </div>
    </div>
</div>
@endsection