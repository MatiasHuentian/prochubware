@php
    $aditional_name = $aditional_name ?? null;
    $list_name = $list_name ?? 'processesUpgradeProposal';
@endphp
{{-- <div class="form-group {{ $errors->has($list_name . '.description') ? 'invalid' : '' }}">
    <label class="form-label"
        for="description">{{ trans('cruds.processesUpgradeProposal.fields.description') . $aditional_name }}</label>
    <textarea class="form-control" name="description" id="{{ $list_name }}description"
        wire:model.defer="{{ $list_name }}.description" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first($list_name . '.description') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesUpgradeProposal.fields.description_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has($list_name . '.calculate_form') ? 'invalid' : '' }}">
    <label class="form-label"
        for="calculate_form">{{ trans('cruds.processesUpgradeProposal.fields.calculate_form') . $aditional_name }}</label>
    <textarea class="form-control" name="calculate_form" id="{{ $list_name }}calculate_form"
        wire:model.defer="{{ $list_name }}.calculate_form" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first($list_name . '.calculate_form') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesUpgradeProposal.fields.calculate_form_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has($list_name . '.ubication_data') ? 'invalid' : '' }}">
    <label class="form-label"
        for="ubication_data">{{ trans('cruds.processesUpgradeProposal.fields.ubication_data') . $aditional_name }}</label>
    <textarea class="form-control" name="ubication_data" id="{{ $list_name }}ubication_data"
        wire:model.defer="{{ $list_name }}.ubication_data" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first($list_name . '.ubication_data') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesUpgradeProposal.fields.ubication_data_helper') }}
    </div>
</div> --}}





<div class="form-group {{ $errors->has($list_name . '.status_id') ? 'invalid' : '' }}">
    <label class="form-label required"
        for="status">{{ trans('cruds.processesUpgradeProposal.fields.status') . $aditional_name }}</label>
    <x-select-list class="form-control" required id="{{ $list_name }}status" name="status" :options="$this->listsForFields['upgrades_proposals_states']"
        wire:model="{{ $list_name }}.status_id" />
    <div class="validation-message">
        {{ $errors->first($list_name . '.status_id') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesUpgradeProposal.fields.status_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has($list_name . '.description') ? 'invalid' : '' }}">
    <label class="form-label required"
        for="description">{{ trans('cruds.processesUpgradeProposal.fields.description') . $aditional_name }}</label>
    <textarea class="form-control" name="description" id="{{ $list_name }}description" required
        wire:model.defer="{{ $list_name }}.description" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first($list_name . '.description') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesUpgradeProposal.fields.description_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has($list_name . '.deadline') ? 'invalid' : '' }}">
    <label class="form-label"
        for="deadline">{{ trans('cruds.processesUpgradeProposal.fields.deadline') . $aditional_name }}</label>
    <x-date-picker-v2 class="form-control" wire:model="{{ $list_name }}.deadline" id="processesUpgradeProposal-{{ $in }}deadline"
        name="deadline" picker="date" model-id="processesUpgradeProposal-{{ $in }}" in="{{ $in }}" />
    <div class="validation-message">
        {{ $errors->first($list_name . '.deadline') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesUpgradeProposal.fields.deadline_helper') }}
    </div>
</div>
