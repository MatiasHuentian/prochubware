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
        <label class="form-label required" for="name">{{ trans('cruds.processesKpi.fields.name') . $aditional_name }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="processesKpi.name">
        <div class="validation-message">
            {{ $errors->first('processesKpi.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesKpi.fields.name_helper') }}
        </div>
    </div>

    @include('livewire.processes-kpi.partials.clean' , [ 'aditional_name' => null ])

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.processes-kpis.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
