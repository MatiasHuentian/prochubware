<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('attachmentsType.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.attachmentsType.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="attachmentsType.name">
        <div class="validation-message">
            {{ $errors->first('attachmentsType.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.attachmentsType.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('attachmentsType.active') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="active" id="active" required wire:model.defer="attachmentsType.active">
        <label class="form-label inline ml-1 required" for="active">{{ trans('cruds.attachmentsType.fields.active') }}</label>
        <div class="validation-message">
            {{ $errors->first('attachmentsType.active') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.attachmentsType.fields.active_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.attachments-types.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>