@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.attachmentsCategory.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('attachments_category_create')
                    <a class="btn btn-indigo" href="{{ route('admin.attachments-categories.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.attachmentsCategory.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('attachments-category.index')

    </div>
</div>
@endsection