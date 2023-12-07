@php
    $aditional_name = $aditional_name ?? null;
    $list_name = $list_name ?? 'processesKpi';
@endphp
<div class="form-group {{ $errors->has($list_name . '.description') ? 'invalid' : '' }}">
    <label class="form-label" for="description">{{ trans('cruds.processesKpi.fields.description') . $aditional_name }}</label>
    <textarea class="form-control" name="description" id="{{ $list_name }}description" wire:model.defer="{{ $list_name }}.description" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first($list_name . '.description') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesKpi.fields.description_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has($list_name . '.calculate_form') ? 'invalid' : '' }}">
    <label class="form-label" for="calculate_form">{{ trans('cruds.processesKpi.fields.calculate_form') . $aditional_name }}</label>
    <textarea class="form-control" name="calculate_form" id="{{ $list_name }}calculate_form" wire:model.defer="{{ $list_name }}.calculate_form" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first($list_name . '.calculate_form') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesKpi.fields.calculate_form_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has($list_name . '.ubication_data') ? 'invalid' : '' }}">
    <label class="form-label" for="ubication_data">{{ trans('cruds.processesKpi.fields.ubication_data') . $aditional_name }}</label>
    <textarea class="form-control" name="ubication_data" id="{{ $list_name }}ubication_data" wire:model.defer="{{ $list_name }}.ubication_data" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first($list_name . '.ubication_data') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesKpi.fields.ubication_data_helper') }}
    </div>
</div>
