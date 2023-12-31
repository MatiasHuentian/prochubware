<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            por pág.:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('attachments_type_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Eliminar seleccionadas') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="AttachmentsType" format="csv" />
                <livewire:excel-export model="AttachmentsType" format="xlsx" />
                <livewire:excel-export model="AttachmentsType" format="pdf" />
            @endif


            @can('attachments_type_create')
                <x-csv-import route="{{ route('admin.attachments-types.csv.store') }}" />
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
                            {{ trans('cruds.attachmentsType.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.attachmentsType.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.attachmentsType.fields.active') }}
                            @include('components.table.sort', ['field' => 'active'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attachmentsTypes as $attachmentsType)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $attachmentsType->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $attachmentsType->id }}
                            </td>
                            <td>
                                {{ $attachmentsType->name }}
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $attachmentsType->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('attachments_type_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.attachments-types.show', $attachmentsType) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('attachments_type_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.attachments-types.edit', $attachmentsType) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('attachments_type_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $attachmentsType->id }})" wire:loading.attr="disabled">
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
            {{ $attachmentsTypes->links() }}
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
