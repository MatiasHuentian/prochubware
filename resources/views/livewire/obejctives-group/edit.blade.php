<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('obejctivesGroup.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.obejctivesGroup.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="obejctivesGroup.name">
        <div class="validation-message">
            {{ $errors->first('obejctivesGroup.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.obejctivesGroup.fields.name_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.obejctives-groups.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>