<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('processesActivity.process_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="process">{{ trans('cruds.processesActivity.fields.process') }}</label>
        <x-select-list class="form-control" required id="process" name="process" :options="$this->listsForFields['process']"
            wire:model="processesActivity.process_id" />
        <div class="validation-message">
            {{ $errors->first('processesActivity.process_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesActivity.fields.process_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has(($clean_model ?? 'processesActivity') . '.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="{{ ($clean_model ?? 'processesActivity') }}_name">{{ trans('cruds.processesActivity.fields.name') }}</label>
        <input class="form-control" type="text" id="{{ ($clean_model ?? 'processesActivity') }}_name" required
            wire:model.defer="{{ ($clean_model ?? 'processesActivity') }}.name">
        <div class="validation-message">
            {{ $errors->first( ($clean_model ?? 'processesActivity') . '.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesActivity.fields.name_helper') }}
        </div>
    </div>

    @include('livewire.processes-activity.partials.clean', [
        'name'          => 'Riesgo',
        'plural_name'   => null,
        'list_name'     => 'activitiesRisk',
        'list'          => $activitiesRisk,
    ])
    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.processes-activities.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>

</form>
