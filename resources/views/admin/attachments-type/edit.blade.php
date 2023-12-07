@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.attachmentsType.title_singular') }}:
                    {{ trans('cruds.attachmentsType.fields.id') }}
                    {{ $attachmentsType->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('attachments-type.edit', [$attachmentsType])
        </div>
    </div>
</div>
@endsection