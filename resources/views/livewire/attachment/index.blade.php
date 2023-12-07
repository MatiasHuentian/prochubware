<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('attachment_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Attachment" format="csv" />
                <livewire:excel-export model="Attachment" format="xlsx" />
                <livewire:excel-export model="Attachment" format="pdf" />
            @endif


            @can('attachment_create')
                <x-csv-import route="{{ route('admin.attachments.csv.store') }}" />
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
                            {{ trans('cruds.attachment.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.attachment.fields.process') }}
                            @include('components.table.sort', ['field' => 'process.name'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.objective') }}
                            @include('components.table.sort', ['field' => 'process.objective'])
                        </th>
                        <th>
                            {{ trans('cruds.attachment.fields.type') ?? 'Tipo'  }}
                            @include('components.table.sort', ['field' => 'onemedia.mime_type'])
                        </th>
                        {{-- <th>
                            {{ trans('cruds.attachment.fields.type') }}
                            @include('components.table.sort', ['field' => 'type.name'])
                        </th> --}}
                        {{-- <th>
                            {{ trans('cruds.attachmentsType.fields.active') }}
                            @include('components.table.sort', ['field' => 'type.active'])
                        </th> --}}
                        <th>
                            {{ trans('cruds.attachment.fields.category') }}
                            @include('components.table.sort', ['field' => 'category.name'])
                        </th>
                        <th>
                            {{ trans('cruds.attachment.fields.description') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attachments as $attachment)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $attachment->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $attachment->id }}
                            </td>
                            <td>
                                @if($attachment->process)
                                    <span class="badge badge-relationship">{{ $attachment->process->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($attachment->process)
                                    {{ $attachment->process->objective ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($attachment->onemedia)
                                    <span class="badge badge-relationship">{{ $attachment->MimeTypeForHuman ?? '' }}</span>
                                @endif
                            </td>
                            {{-- <td>
                                @if($attachment->type)
                                    <span class="badge badge-relationship">{{ $attachment->type->name ?? '' }}</span>
                                @endif
                            </td> --}}
                            {{-- <td>
                                @if($attachment->type)
                                    <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $attachment->type->active ? 'checked' : '' }}>
                                @endif
                            </td> --}}
                            <td>
                                @if($attachment->category)
                                    <span class="badge badge-relationship">{{ $attachment->category->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $attachment->description }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('attachment_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.attachments.show', $attachment) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('attachment_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.attachments.edit', $attachment) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('attachment_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $attachment->id }})" wire:loading.attr="disabled">
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
            {{ $attachments->links() }}
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
