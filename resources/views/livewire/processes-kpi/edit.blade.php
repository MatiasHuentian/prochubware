<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('processesKpi.process_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="process">{{ trans('cruds.processesKpi.fields.process') }}</label>
        <x-select-list class="form-control" required id="process" name="process" :options="$this->listsForFields['process']" wire:model="processesKpi.process_id" />
        <div class="validation-message">
            {{ $errors->first('processesKpi.process_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesKpi.fields.process_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesKpi.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.processesKpi.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="processesKpi.name">
        <div class="validation-message">
            {{ $errors->first('processesKpi.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesKpi.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesKpi.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.processesKpi.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" wire:model.defer="processesKpi.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('processesKpi.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesKpi.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesKpi.calculate_form') ? 'invalid' : '' }}">
        <label class="form-label" for="calculate_form">{{ trans('cruds.processesKpi.fields.calculate_form') }}</label>
        <textarea class="form-control" name="calculate_form" id="calculate_form" wire:model.defer="processesKpi.calculate_form" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('processesKpi.calculate_form') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesKpi.fields.calculate_form_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesKpi.ubication_data') ? 'invalid' : '' }}">
        <label class="form-label" for="ubication_data">{{ trans('cruds.processesKpi.fields.ubication_data') }}</label>
        <textarea class="form-control" name="ubication_data" id="ubication_data" wire:model.defer="processesKpi.ubication_data" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('processesKpi.ubication_data') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesKpi.fields.ubication_data_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.processes-kpis.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>