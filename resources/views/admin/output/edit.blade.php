@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.output.title_singular') }}:
                    {{ trans('cruds.output.fields.id') }}
                    {{ $output->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('output.edit', [$output])
        </div>
    </div>
</div>
@endsection