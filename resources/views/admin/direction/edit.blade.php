@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.direction.title_singular') }}:
                    {{ trans('cruds.direction.fields.id') }}
                    {{ $direction->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('direction.edit', [$direction])
        </div>
    </div>
</div>
@endsection