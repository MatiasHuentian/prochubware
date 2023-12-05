<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('attachmentsCategory.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.attachmentsCategory.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="attachmentsCategory.name">
        <div class="validation-message">
            {{ $errors->first('attachmentsCategory.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.attachmentsCategory.fields.name_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.attachments-categories.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>