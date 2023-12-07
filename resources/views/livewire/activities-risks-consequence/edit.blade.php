<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('activitiesRisksConsequence.risk_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="risk">{{ trans('cruds.activitiesRisksConsequence.fields.risk') }}</label>
        <x-select-list class="form-control" required id="risk" name="risk" :options="$this->listsForFields['risk']" wire:model="activitiesRisksConsequence.risk_id" />
        <div class="validation-message">
            {{ $errors->first('activitiesRisksConsequence.risk_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisksConsequence.fields.risk_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('activitiesRisksConsequence.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.activitiesRisksConsequence.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="activitiesRisksConsequence.name">
        <div class="validation-message">
            {{ $errors->first('activitiesRisksConsequence.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisksConsequence.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('activitiesRisksConsequence.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.activitiesRisksConsequence.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" wire:model.defer="activitiesRisksConsequence.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('activitiesRisksConsequence.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisksConsequence.fields.description_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.activities-risks-consequences.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>