<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('risksControl.risk_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="risk">{{ trans('cruds.risksControl.fields.risk') }}</label>
        <x-select-list class="form-control" required id="risk" name="risk" :options="$this->listsForFields['risk']" wire:model="risksControl.risk_id" />
        <div class="validation-message">
            {{ $errors->first('risksControl.risk_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.risksControl.fields.risk_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('risksControl.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.risksControl.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="risksControl.name">
        <div class="validation-message">
            {{ $errors->first('risksControl.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.risksControl.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('risksControl.frecuency_id') ? 'invalid' : '' }}">
        <label class="form-label" for="frecuency">{{ trans('cruds.risksControl.fields.frecuency') }}</label>
        <x-select-list class="form-control" id="frecuency" name="frecuency" :options="$this->listsForFields['frecuency']" wire:model="risksControl.frecuency_id" />
        <div class="validation-message">
            {{ $errors->first('risksControl.frecuency_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.risksControl.fields.frecuency_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('risksControl.method_id') ? 'invalid' : '' }}">
        <label class="form-label" for="method">{{ trans('cruds.risksControl.fields.method') }}</label>
        <x-select-list class="form-control" id="method" name="method" :options="$this->listsForFields['method']" wire:model="risksControl.method_id" />
        <div class="validation-message">
            {{ $errors->first('risksControl.method_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.risksControl.fields.method_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('risksControl.type_id') ? 'invalid' : '' }}">
        <label class="form-label" for="type">{{ trans('cruds.risksControl.fields.type') }}</label>
        <x-select-list class="form-control" id="type" name="type" :options="$this->listsForFields['type']" wire:model="risksControl.type_id" />
        <div class="validation-message">
            {{ $errors->first('risksControl.type_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.risksControl.fields.type_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.risks-controls.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
