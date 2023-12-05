@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.attachment.title_singular') }}:
                    {{ trans('cruds.attachment.fields.id') }}
                    {{ $attachment->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('attachment.edit', [$attachment])
        </div>
    </div>
</div>
@endsection