<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('processes_upgrade_proposal_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="ProcessesUpgradeProposal" format="csv" />
                <livewire:excel-export model="ProcessesUpgradeProposal" format="xlsx" />
                <livewire:excel-export model="ProcessesUpgradeProposal" format="pdf" />
            @endif


            @can('processes_upgrade_proposal_create')
                <x-csv-import route="{{ route('admin.processes-upgrade-proposals.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.processesUpgradeProposal.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.processesUpgradeProposal.fields.process') }}
                            @include('components.table.sort', ['field' => 'process.name'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.introduction') }}
                            @include('components.table.sort', ['field' => 'process.introduction'])
                        </th>
                        <th>
                            {{ trans('cruds.processesUpgradeProposal.fields.status') }}
                            @include('components.table.sort', ['field' => 'status.name'])
                        </th>
                        <th>
                            {{ trans('cruds.upgradeProposalsState.fields.color') }}
                            @include('components.table.sort', ['field' => 'status.color'])
                        </th>
                        <th>
                            {{ trans('cruds.processesUpgradeProposal.fields.description') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        <th>
                            {{ trans('cruds.processesUpgradeProposal.fields.deadline') }}
                            @include('components.table.sort', ['field' => 'deadline'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processesUpgradeProposals as $processesUpgradeProposal)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $processesUpgradeProposal->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $processesUpgradeProposal->id }}
                            </td>
                            <td>
                                @if($processesUpgradeProposal->process)
                                    <span class="badge badge-relationship">{{ $processesUpgradeProposal->process->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($processesUpgradeProposal->process)
                                    {{ $processesUpgradeProposal->process->introduction ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($processesUpgradeProposal->status)
                                    <span class="badge badge-relationship">{{ $processesUpgradeProposal->status->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($processesUpgradeProposal->status)
                                    {{ $processesUpgradeProposal->status->color ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $processesUpgradeProposal->description }}
                            </td>
                            <td>
                                {{ $processesUpgradeProposal->deadline }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('processes_upgrade_proposal_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.processes-upgrade-proposals.show', $processesUpgradeProposal) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('processes_upgrade_proposal_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.processes-upgrade-proposals.edit', $processesUpgradeProposal) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('processes_upgrade_proposal_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $processesUpgradeProposal->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $processesUpgradeProposals->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush