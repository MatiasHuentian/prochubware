<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            por pág.:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('process_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button"
                    wire:click="confirm('deleteSelected')" wire:loading.attr="disabled"
                    {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Eliminar seleccionadas') }}
                </button>
            @endcan

            @if (file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Process" format="csv" />
                <livewire:excel-export model="Process" format="xlsx" />
                <livewire:excel-export model="Process" format="pdf" />
            @endif


            @can('process_create')
                <x-csv-import route="{{ route('admin.processes.csv.store') }}" />
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
        <div id="scroll-controls" class="flex justify-between w-full px-4 py-2 mt-4">
            <button id="scroll-left" class="flex items-center btn btn-info text-white px-4 py-2 rounded-lg focus:outline-none">
                <i class="fas fa-chevron-left mr-2"></i> <!-- Icono de flecha hacia la izquierda -->
                Desplazar a la izquierda
            </button>
            <button id="scroll-right" class="flex items-center btn btn-info text-white px-4 py-2 rounded-lg focus:outline-none">
                Desplazar a la derecha
                <i class="fas fa-chevron-right ml-2"></i> <!-- Icono de flecha hacia la derecha -->
            </button>
        </div>


        <div class="overflow-x-auto" id="table-container">
            <table class="table table-index w-full" id="data-table">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.process.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        {{-- <th>
                            {{ trans('cruds.user.fields.email') }}
                            @include('components.table.sort', ['field' => 'owner.email'])
                        </th> --}}
                        <th>
                            {{ trans('cruds.process.fields.dependency') }}
                            @include('components.table.sort', ['field' => 'dependency.name'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.state') }}
                            @include('components.table.sort', ['field' => 'state.name'])
                        </th>
                        {{-- <th>
                            {{ trans('cruds.processesState.fields.color') }}
                            @include('components.table.sort', ['field' => 'state.color'])
                        </th> --}}
                        <th>
                            {{ trans('cruds.process.fields.start_date') }}
                            @include('components.table.sort', ['field' => 'start_date'])
                        </th>
                        <th>
                            {{ trans('cruds.process.fields.end_date') }}
                            @include('components.table.sort', ['field' => 'end_date'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processes as $process)
                        <tr style="background-color: #{{ $process->state->color }}">
                            <td>
                                <input type="checkbox" value="{{ $process->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $process->id }}
                            </td>
                            <td>
                                {{ $process->name }}
                            </td>
                            <td>
                                @if ($process->owner)
                                    <span class="badge badge-relationship">{{ $process->owner->name ?? '' }}</span>
                                @endif
                            </td>
                            {{-- <td>
                                @if ($process->owner)
                                    <a class="link-light-blue" href="mailto:{{ $process->owner->email ?? '' }}">
                                        <i class="far fa-envelope fa-fw">
                                        </i>
                                        {{ $process->owner->email ?? '' }}
                                    </a>
                                @endif
                            </td> --}}
                            <td>
                                @if ($process->dependency)
                                    <span
                                        class="badge badge-relationship">{{ $process->dependency->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($process->state)
                                    <span class="badge badge-relationship">{{ $process->state->name ?? '' }}</span>
                                @endif
                            </td>
                            {{-- <td>
                                @if ($process->state)
                                    {{ $process->state->color ?? '' }}
                                @endif
                            </td> --}}
                            <td>
                                {{ $process->start_date }}
                            </td>
                            <td>
                                {{ $process->end_date }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('process_show')
                                        <a class="btn btn-sm btn-info mr-2"
                                            href="{{ route('admin.processes.show', $process) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('process_edit')
                                        <a class="btn btn-sm btn-success mr-2"
                                            href="{{ route('admin.processes.edit', $process) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('process_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button"
                                            wire:click="confirm('delete', {{ $process->id }})"
                                            wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                    @can('process_export_word')
                                        <a class="btn btn-sm btn-info mr-2" target="_blank"
                                            href="{{ route('admin.processes.word.export', $process) }}">
                                            {{ __('WORD') }}
                                        </a>
                                    @endcan
                                    @can('process_export_pdf')
                                        <a class="btn btn-sm btn-rose mr-2" target="_blank"
                                            href="{{ route('admin.processes.pdf.export', $process) }}">
                                            {{ __('PDF') }}
                                        </a>
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
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $processes->links() }}
        </div>
    </div>
</div>

@push('styles')
    <style>
        #scroll-controls {
            margin-top: 10px;
            text-align: center;
        }

        #scroll-controls button {
            margin: 0 5px;
            padding: 5px 50px;
            font-size: 14px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Handler para desplazarse a la izquierda
            $('#scroll-left').click(function() {
                var leftPos = $('#table-container').scrollLeft();
                $('#table-container').animate({
                    scrollLeft: leftPos - 100
                }, 300);
            });

            // Handler para desplazarse a la derecha
            $('#scroll-right').click(function() {
                var leftPos = $('#table-container').scrollLeft();
                $('#table-container').animate({
                    scrollLeft: leftPos + 100
                }, 300);
            });
        });


        Livewire.on('confirm', e => {
            if (!confirm("{{ trans('global.areYouSure') }}")) {
                return
            }
            @this[e.callback](...e.argv)
        })
    </script>
@endpush
