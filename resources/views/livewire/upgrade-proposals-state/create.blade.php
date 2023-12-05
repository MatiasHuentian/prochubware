<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('upgradeProposalsState.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.upgradeProposalsState.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="upgradeProposalsState.name">
        <div class="validation-message">
            {{ $errors->first('upgradeProposalsState.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.upgradeProposalsState.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('upgradeProposalsState.color') ? 'invalid' : '' }}">
        <label class="form-label required" for="color">{{ trans('cruds.upgradeProposalsState.fields.color') }}</label>
        <input class="form-control" type="text" name="color" id="color" required wire:model.defer="upgradeProposalsState.color">
        <div class="validation-message">
            {{ $errors->first('upgradeProposalsState.color') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.upgradeProposalsState.fields.color_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.upgrade-proposals-states.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>