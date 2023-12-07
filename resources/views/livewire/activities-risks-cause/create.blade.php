<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('activitiesRisksCause.risk_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="risk">{{ trans('cruds.activitiesRisksCause.fields.risk') }}</label>
        <x-select-list class="form-control" required id="risk" name="risk" :options="$this->listsForFields['risk']" wire:model="activitiesRisksCause.risk_id" />
        <div class="validation-message">
            {{ $errors->first('activitiesRisksCause.risk_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisksCause.fields.risk_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('activitiesRisksCause.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.activitiesRisksCause.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="activitiesRisksCause.name">
        <div class="validation-message">
            {{ $errors->first('activitiesRisksCause.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisksCause.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('activitiesRisksCause.description') ? 'invalid' : '' }}">
        <label class="form-label required" for="description">{{ trans('cruds.activitiesRisksCause.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" required wire:model.defer="activitiesRisksCause.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('activitiesRisksCause.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisksCause.fields.description_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.activities-risks-causes.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>