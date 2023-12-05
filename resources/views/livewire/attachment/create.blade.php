<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('attachment.process_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="process">{{ trans('cruds.attachment.fields.process') }}</label>
        <x-select-list class="form-control" required id="process" name="process" :options="$this->listsForFields['process']" wire:model="attachment.process_id" />
        <div class="validation-message">
            {{ $errors->first('attachment.process_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.attachment.fields.process_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('attachment.category_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="category">{{ trans('cruds.attachment.fields.category') }}</label>
        <x-select-list class="form-control" required id="category" name="category" :options="$this->listsForFields['category']" wire:model="attachment.category_id" />
        <div class="validation-message">
            {{ $errors->first('attachment.category_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.attachment.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.attachment_src') ? 'invalid' : '' }}">
        <label class="form-label" for="src">{{ trans('cruds.attachment.fields.src') }}</label>
        <x-dropzone id="src" name="src" action="{{ route('admin.attachments.storeMedia') }}" collection-name="attachment_src" max-file-size="2" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.attachment_src') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.attachment.fields.src_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('attachment.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.attachment.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" wire:model.defer="attachment.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('attachment.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.attachment.fields.description_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.attachments.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
