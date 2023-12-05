@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.obejctivesGroup.title_singular') }}:
                    {{ trans('cruds.obejctivesGroup.fields.id') }}
                    {{ $obejctivesGroup->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('obejctives-group.edit', [$obejctivesGroup])
        </div>
    </div>
</div>
@endsection