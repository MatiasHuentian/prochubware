<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('processes_kpi_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="ProcessesKpi" format="csv" />
                <livewire:excel-export model="ProcessesKpi" format="xlsx" />
                <livewire:excel-export model="ProcessesKpi" format="pdf" />
            @endif


            @can('processes_kpi_create')
                <x-csv-import route="{{ route('admin.processes-kpis.csv.store') }}" />
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
                            {{ trans('cruds.processesKpi.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.processesKpi.fields.process') }}
                            @include('components.table.sort', ['field' => 'process.name'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.start_date') }}
                            @include('components.table.sort', ['field' => 'process.start_date'])
                        </th>
                        <th>
                            {{ trans('cruds.processesKpi.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.processesKpi.fields.calculate_form') }}
                            @include('components.table.sort', ['field' => 'calculate_form'])
                        </th>
                        <th>
                            {{ trans('cruds.processesKpi.fields.ubication_data') }}
                            @include('components.table.sort', ['field' => 'ubication_data'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processesKpis as $processesKpi)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $processesKpi->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $processesKpi->id }}
                            </td>
                            <td>
                                @if($processesKpi->process)
                                    <span class="badge badge-relationship">{{ $processesKpi->process->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($processesKpi->process)
                                    {{ $processesKpi->process->start_date ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $processesKpi->name }}
                            </td>
                            <td>
                                {{ $processesKpi->calculate_form }}
                            </td>
                            <td>
                                {{ $processesKpi->ubication_data }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('processes_kpi_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.processes-kpis.show', $processesKpi) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('processes_kpi_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.processes-kpis.edit', $processesKpi) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('processes_kpi_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $processesKpi->id }})" wire:loading.attr="disabled">
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
            {{ $processesKpis->links() }}
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