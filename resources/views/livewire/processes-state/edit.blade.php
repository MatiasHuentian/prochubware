<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('processesState.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.processesState.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="processesState.name">
        <div class="validation-message">
            {{ $errors->first('processesState.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesState.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesState.color') ? 'invalid' : '' }}">
        <label class="form-label required" for="color">{{ trans('cruds.processesState.fields.color') }}</label>
        <input class="form-control" type="text" name="color" id="color" required wire:model.defer="processesState.color">
        <div class="validation-message">
            {{ $errors->first('processesState.color') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesState.fields.color_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.processes-states.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>