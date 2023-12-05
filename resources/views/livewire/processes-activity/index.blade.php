<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('processes_activity_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="ProcessesActivity" format="csv" />
                <livewire:excel-export model="ProcessesActivity" format="xlsx" />
                <livewire:excel-export model="ProcessesActivity" format="pdf" />
            @endif


            @can('processes_activity_create')
                <x-csv-import route="{{ route('admin.processes-activities.csv.store') }}" />
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
                            {{ trans('cruds.processesActivity.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.processesActivity.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.processesActivity.fields.process') }}
                            @include('components.table.sort', ['field' => 'process.name'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.start_date') }}
                            @include('components.table.sort', ['field' => 'process.start_date'])
                        </th>
                        <th>
                            {{ trans('cruds.processesActivity.fields.description') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processesActivities as $processesActivity)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $processesActivity->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $processesActivity->id }}
                            </td>
                            <td>
                                {{ $processesActivity->name }}
                            </td>
                            <td>
                                @if($processesActivity->process)
                                    <span class="badge badge-relationship">{{ $processesActivity->process->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($processesActivity->process)
                                    {{ $processesActivity->process->start_date ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $processesActivity->description }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('processes_activity_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.processes-activities.show', $processesActivity) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('processes_activity_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.processes-activities.edit', $processesActivity) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('processes_activity_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $processesActivity->id }})" wire:loading.attr="disabled">
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
            {{ $processesActivities->links() }}
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