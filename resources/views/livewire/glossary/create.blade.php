<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('glossary.term') ? 'invalid' : '' }}">
        <label class="form-label required" for="term">{{ trans('cruds.glossary.fields.term') }}</label>
        <input class="form-control" type="text" name="term" id="term" required wire:model.defer="glossary.term">
        <div class="validation-message">
            {{ $errors->first('glossary.term') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.glossary.fields.term_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.glossaries.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>