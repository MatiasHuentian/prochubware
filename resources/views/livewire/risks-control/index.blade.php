<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            por pág.:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('risks_control_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Eliminar seleccionadas') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="RisksControl" format="csv" />
                <livewire:excel-export model="RisksControl" format="xlsx" />
                <livewire:excel-export model="RisksControl" format="pdf" />
            @endif


            @can('risks_control_create')
                <x-csv-import route="{{ route('admin.risks-controls.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Buscar:
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
                            {{ trans('cruds.risksControl.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.risksControl.fields.risk') }}
                            @include('components.table.sort', ['field' => 'risk.name'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.description') }}
                            @include('components.table.sort', ['field' => 'risk.description'])
                        </th>
                        <th>
                            {{ trans('cruds.risksControl.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.risksControl.fields.frecuency') }}
                            @include('components.table.sort', ['field' => 'frecuency.name'])
                        </th>
                        <th>
                            {{ trans('cruds.risksControl.fields.method') }}
                            @include('components.table.sort', ['field' => 'method.name'])
                        </th>
                        <th>
                            {{ trans('cruds.risksControl.fields.type') }}
                            @include('components.table.sort', ['field' => 'type.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($risksControls as $risksControl)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $risksControl->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $risksControl->id }}
                            </td>
                            <td>
                                @if($risksControl->risk)
                                    <span class="badge badge-relationship">{{ $risksControl->risk->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($risksControl->risk)
                                    {{ $risksControl->risk->description ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $risksControl->name }}
                            </td>
                            <td>
                                @if($risksControl->frecuency)
                                    <span class="badge badge-relationship">{{ $risksControl->frecuency->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($risksControl->method)
                                    <span class="badge badge-relationship">{{ $risksControl->method->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($risksControl->type)
                                    <span class="badge badge-relationship">{{ $risksControl->type->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('risks_control_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.risks-controls.show', $risksControl) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('risks_control_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.risks-controls.edit', $risksControl) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('risks_control_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $risksControl->id }})" wire:loading.attr="disabled">
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
            {{ $risksControls->links() }}
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
