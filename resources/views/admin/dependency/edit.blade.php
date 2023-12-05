@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.dependency.title_singular') }}:
                    {{ trans('cruds.dependency.fields.id') }}
                    {{ $dependency->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('dependency.edit', [$dependency])
        </div>
    </div>
</div>
@endsection