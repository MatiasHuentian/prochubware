<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('activities_risks_consequence_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="ActivitiesRisksConsequence" format="csv" />
                <livewire:excel-export model="ActivitiesRisksConsequence" format="xlsx" />
                <livewire:excel-export model="ActivitiesRisksConsequence" format="pdf" />
            @endif


            @can('activities_risks_consequence_create')
                <x-csv-import route="{{ route('admin.activities-risks-consequences.csv.store') }}" />
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
                            {{ trans('cruds.activitiesRisksConsequence.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisksConsequence.fields.risk') }}
                            @include('components.table.sort', ['field' => 'risk.name'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.description') }}
                            @include('components.table.sort', ['field' => 'risk.description'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisksConsequence.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activitiesRisksConsequences as $activitiesRisksConsequence)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $activitiesRisksConsequence->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $activitiesRisksConsequence->id }}
                            </td>
                            <td>
                                @if($activitiesRisksConsequence->risk)
                                    <span class="badge badge-relationship">{{ $activitiesRisksConsequence->risk->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($activitiesRisksConsequence->risk)
                                    {{ $activitiesRisksConsequence->risk->description ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $activitiesRisksConsequence->name }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('activities_risks_consequence_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.activities-risks-consequences.show', $activitiesRisksConsequence) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('activities_risks_consequence_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.activities-risks-consequences.edit', $activitiesRisksConsequence) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('activities_risks_consequence_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $activitiesRisksConsequence->id }})" wire:loading.attr="disabled">
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
            {{ $activitiesRisksConsequences->links() }}
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