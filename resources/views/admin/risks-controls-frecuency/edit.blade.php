@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.risksControlsFrecuency.title_singular') }}:
                    {{ trans('cruds.risksControlsFrecuency.fields.id') }}
                    {{ $risksControlsFrecuency->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('risks-controls-frecuency.edit', [$risksControlsFrecuency])
        </div>
    </div>
</div>
@endsection