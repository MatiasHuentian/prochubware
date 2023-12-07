<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('dependency.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.dependency.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="dependency.name">
        <div class="validation-message">
            {{ $errors->first('dependency.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dependency.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dependency.direction_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="direction">{{ trans('cruds.dependency.fields.direction') }}</label>
        <x-select-list class="form-control" required id="direction" name="direction" :options="$this->listsForFields['direction']" wire:model="dependency.direction_id" />
        <div class="validation-message">
            {{ $errors->first('dependency.direction_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dependency.fields.direction_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.dependencies.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>