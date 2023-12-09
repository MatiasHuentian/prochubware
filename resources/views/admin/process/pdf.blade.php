<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.process.title_singular') }}:
                    {{ trans('cruds.process.fields.id') }}
                    {{ $process->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.id') }}
                            </th>
                            <td>
                                {{ $process->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.name') }}
                            </th>
                            <td>
                                {{ $process->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.owner') }}
                            </th>
                            <td>
                                @if ($process->owner)
                                    <span class="badge badge-relationship">{{ $process->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.objective') }}
                            </th>
                            <td>
                                {{ $process->objective }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.dependency') }}
                            </th>
                            <td>
                                @if ($process->dependency)
                                    <span
                                        class="badge badge-relationship">{{ $process->dependency->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.state') }}
                            </th>
                            <td>
                                @if ($process->state)
                                    <span class="badge badge-relationship">{{ $process->state->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.introduction') }}
                            </th>
                            <td>
                                {{ $process->introduction }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.contextual_memo') }}
                            </th>
                            <td>
                                {{ $process->contextual_memo }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.start_date') }}
                            </th>
                            <td>
                                {{ $process->start_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.end_date') }}
                            </th>
                            <td>
                                {{ $process->end_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.glosary') }}
                            </th>
                            <td>
                                @foreach ($process->glosary as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->term }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.input') }}
                            </th>
                            <td>
                                @foreach ($process->input as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.output') }}
                            </th>
                            <td>
                                @foreach ($process->output as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.process.fields.objective_group') }}
                            </th>
                            <td>
                                @foreach ($process->objectiveGroup as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('process_edit')
                    <a href="{{ route('admin.processes.edit', $process) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.processes.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
