<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('processesUpgradeProposal.process_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="process">{{ trans('cruds.processesUpgradeProposal.fields.process') }}</label>
        <x-select-list class="form-control" required id="process" name="process" :options="$this->listsForFields['process']" wire:model="processesUpgradeProposal.process_id" />
        <div class="validation-message">
            {{ $errors->first('processesUpgradeProposal.process_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesUpgradeProposal.fields.process_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesUpgradeProposal.status_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="status">{{ trans('cruds.processesUpgradeProposal.fields.status') }}</label>
        <x-select-list class="form-control" required id="status" name="status" :options="$this->listsForFields['status']" wire:model="processesUpgradeProposal.status_id" />
        <div class="validation-message">
            {{ $errors->first('processesUpgradeProposal.status_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesUpgradeProposal.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesUpgradeProposal.description') ? 'invalid' : '' }}">
        <label class="form-label required" for="description">{{ trans('cruds.processesUpgradeProposal.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" required wire:model.defer="processesUpgradeProposal.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('processesUpgradeProposal.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesUpgradeProposal.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('processesUpgradeProposal.deadline') ? 'invalid' : '' }}">
        <label class="form-label" for="deadline">{{ trans('cruds.processesUpgradeProposal.fields.deadline') }}</label>
        <x-date-picker class="form-control" wire:model="processesUpgradeProposal.deadline" id="deadline" name="deadline" picker="date" />
        <div class="validation-message">
            {{ $errors->first('processesUpgradeProposal.deadline') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.processesUpgradeProposal.fields.deadline_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.processes-upgrade-proposals.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>