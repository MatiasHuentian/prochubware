<div class="form-group {{ $errors->has(($clean_model ?? 'activitiesRisk') . '.politic_id') ? 'invalid' : '' }}">
    <label class="form-label"
        for="{{ $clean_model ?? '' }}politic">{{ trans('cruds.activitiesRisk.fields.politic') }}</label>
    <x-select-list class="form-control" id="{{ $clean_model ?? '' }}politic" :options="$this->listsForFields['politic']"
        wire:model="{{ $clean_model ?? 'activitiesRisk' }}.politic_id" />
    <div class="validation-message">
        {{ $errors->first(($clean_model ?? 'activitiesRisk') . '.politic_id') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.activitiesRisk.fields.politic_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has(($clean_model ?? 'activitiesRisk') . '.probability_id') ? 'invalid' : '' }}">
    <label class="form-label required"
        for="{{ $clean_model ?? '' }}probability">{{ trans('cruds.activitiesRisk.fields.probability') }}</label>
    <x-select-list class="form-control" required id="{{ $clean_model ?? '' }}probability" :options="$this->listsForFields['probability']"
        wire:model="{{ ($clean_model ?? 'activitiesRisk') }}.probability_id" />
    <div class="validation-message">
        {{ $errors->first(($clean_model ?? 'activitiesRisk') . '.probability_id') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.activitiesRisk.fields.probability_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has(($clean_model ?? 'activitiesRisk') . '.impact_id') ? 'invalid' : '' }}">
    <label class="form-label"
        for="{{ $clean_model ?? '' }}impact">{{ trans('cruds.activitiesRisk.fields.impact') }}</label>
    <x-select-list class="form-control" id="{{ $clean_model ?? '' }}impact" :options="$this->listsForFields['impact']"
        wire:model="{{ ($clean_model ?? 'activitiesRisk') }}.impact_id" />
    <div class="validation-message">
        {{ $errors->first(($clean_model ?? 'activitiesRisk') . '.impact_id') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.activitiesRisk.fields.impact_helper') }}
    </div>
</div>
<div class="form-group {{ $errors->has(($clean_model ?? 'activitiesRisk') . '.description') ? 'invalid' : '' }}">
    <label class="form-label"
        for="{{ $clean_model ?? '' }}description">{{ trans('cruds.activitiesRisk.fields.description') }}</label>
    <textarea class="form-control" id="{{ $clean_model ?? '' }}description"
        wire:model.defer="{{ ($clean_model ?? 'activitiesRisk') }}.description" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first(($clean_model ?? 'activitiesRisk') . '.description') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.activitiesRisk.fields.description_helper') }}
    </div>
</div>

@php
    if (isset($personal_list)) {
        if( $personal_list != "activitiesRisk" ){
            $list_causes = $activities[$in]['risks'][$index]['causes'] ?? [];
            $list_consequences = $activities[$in]['risks'][$index]['consequences'] ?? [];
            $list_controls = $activities[$in]['risks'][$index]['controls'] ?? [];
        }else{
            $list_causes = ${$personal_list}[$index]['causes'] ?? [];
            $list_consequences = ${$personal_list}[$index]['consequences'] ?? [];
            $list_controls = ${$personal_list}[$index]['controls'] ?? [];
        }
    }
    if (isset($clean_model)) {
        $clean_model = $clean_model . '.';
    }
@endphp

@include('livewire.activities-risk.partials.has-many', [
    'name' => 'Causa',
    'list_name' => ($clean_model ?? '') . 'causes',
    // El problema está en el list
    'list' => $list_causes ?? $causes,
])

@include('livewire.activities-risk.partials.has-many', [
    'name' => 'Consecuencia',
    'list_name' => ($clean_model ?? '') . 'consequences',
    'list' => $list_consequences ?? $consequences,
])

@include('admin.risks-control.partials.clean', [
    'name' => 'Control',
    'plural_name' => 'es',
    'list_name' => ($clean_model ?? '') . 'controls',
    'list' => $list_controls ?? $controls,
])
