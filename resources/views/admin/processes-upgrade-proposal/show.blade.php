@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.processesUpgradeProposal.title_singular') }}:
                    {{ trans('cruds.processesUpgradeProposal.fields.id') }}
                    {{ $processesUpgradeProposal->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.processesUpgradeProposal.fields.id') }}
                            </th>
                            <td>
                                {{ $processesUpgradeProposal->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesUpgradeProposal.fields.process') }}
                            </th>
                            <td>
                                @if($processesUpgradeProposal->process)
                                    <span class="badge badge-relationship">{{ $processesUpgradeProposal->process->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesUpgradeProposal.fields.status') }}
                            </th>
                            <td>
                                @if($processesUpgradeProposal->status)
                                    <span class="badge badge-relationship">{{ $processesUpgradeProposal->status->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.processesUpgradeProposal.fields.deadline') }}
                            </th>
                            <td>
                                {{ $processesUpgradeProposal->deadline }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('processes_upgrade_proposal_edit')
                    <a href="{{ route('admin.processes-upgrade-proposals.edit', $processesUpgradeProposal) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.processes-upgrade-proposals.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection