<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            por pág.:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('activities_risk_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Eliminar seleccionadas') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="ActivitiesRisk" format="csv" />
                <livewire:excel-export model="ActivitiesRisk" format="xlsx" />
                <livewire:excel-export model="ActivitiesRisk" format="pdf" />
            @endif


            @can('activities_risk_create')
                <x-csv-import route="{{ route('admin.activities-risks.csv.store') }}" />
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
                            {{ trans('cruds.activitiesRisk.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.activity') }}
                            @include('components.table.sort', ['field' => 'activity.name'])
                        </th>
                        <th>
                            {{ trans('cruds.processesActivity.fields.description') }}
                            @include('components.table.sort', ['field' => 'activity.description'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.politic') }}
                            @include('components.table.sort', ['field' => 'politic.name'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.probability') }}
                            @include('components.table.sort', ['field' => 'probability.name'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.impact') }}
                            @include('components.table.sort', ['field' => 'impact.name'])
                        </th>
                        <th>
                            {{ trans('cruds.activitiesRisk.fields.description') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activitiesRisks as $activitiesRisk)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $activitiesRisk->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $activitiesRisk->id }}
                            </td>
                            <td>
                                @if($activitiesRisk->activity)
                                    <span class="badge badge-relationship">{{ $activitiesRisk->activity->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($activitiesRisk->activity)
                                    {{ $activitiesRisk->activity->description ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $activitiesRisk->name }}
                            </td>
                            <td>
                                @if($activitiesRisk->politic)
                                    <span class="badge badge-relationship">{{ $activitiesRisk->politic->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($activitiesRisk->probability)
                                    <span class="badge badge-relationship">{{ $activitiesRisk->probability->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($activitiesRisk->impact)
                                    <span class="badge badge-relationship">{{ $activitiesRisk->impact->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $activitiesRisk->description }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('activities_risk_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.activities-risks.show', $activitiesRisk) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('activities_risk_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.activities-risks.edit', $activitiesRisk) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('activities_risk_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $activitiesRisk->id }})" wire:loading.attr="disabled">
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
            {{ $activitiesRisks->links() }}
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
