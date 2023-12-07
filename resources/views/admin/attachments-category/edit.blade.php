@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.attachmentsCategory.title_singular') }}:
                    {{ trans('cruds.attachmentsCategory.fields.id') }}
                    {{ $attachmentsCategory->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('attachments-category.edit', [$attachmentsCategory])
        </div>
    </div>
</div>
@endsection