@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.glossary.title_singular') }}:
                    {{ trans('cruds.glossary.fields.id') }}
                    {{ $glossary->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('glossary.edit', [$glossary])
        </div>
    </div>
</div>
@endsection