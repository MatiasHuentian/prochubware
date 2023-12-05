@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.output.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('output_create')
                    <a class="btn btn-indigo" href="{{ route('admin.outputs.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.output.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('output.index')

    </div>
</div>
@endsection