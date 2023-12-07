@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.processesState.title_singular') }}:
                    {{ trans('cruds.processesState.fields.id') }}
                    {{ $processesState->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('processes-state.edit', [$processesState])
        </div>
    </div>
</div>
@endsection