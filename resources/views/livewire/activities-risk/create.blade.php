<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('activitiesRisk.activity_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="activity">{{ trans('cruds.activitiesRisk.fields.activity') }}</label>
        <x-select-list class="form-control" required id="activity" name="activity" :options="$this->listsForFields['activity']"
            wire:model="activitiesRisk.activity_id" />
        <div class="validation-message">
            {{ $errors->first('activitiesRisk.activity_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisk.fields.activity_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('activitiesRisk.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.activitiesRisk.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required
            wire:model.defer="activitiesRisk.name">
        <div class="validation-message">
            {{ $errors->first('activitiesRisk.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.activitiesRisk.fields.name_helper') }}
        </div>
    </div>
    @include('livewire.activities-risk.clean', [
        'name'          => 'Riesgo',
        'plural_name'   => null,
        'list_name'     => 'activitiesRisk',
        'list'          => $activitiesRisk,
    ])
    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.activities-risks.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
