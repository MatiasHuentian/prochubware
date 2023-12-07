@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.input.title_singular') }}:
                    {{ trans('cruds.input.fields.id') }}
                    {{ $input->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('input.edit', [$input])
        </div>
    </div>
</div>
@endsection