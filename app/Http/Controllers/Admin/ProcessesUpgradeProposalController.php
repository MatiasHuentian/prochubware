<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ProcessesUpgradeProposal;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProcessesUpgradeProposalController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('processes_upgrade_proposal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-upgrade-proposal.index');
    }

    public function create()
    {
        abort_if(Gate::denies('processes_upgrade_proposal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-upgrade-proposal.create');
    }

    public function edit(ProcessesUpgradeProposal $processesUpgradeProposal)
    {
        abort_if(Gate::denies('processes_upgrade_proposal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.processes-upgrade-proposal.edit', compact('processesUpgradeProposal'));
    }

    public function show(ProcessesUpgradeProposal $processesUpgradeProposal)
    {
        abort_if(Gate::denies('processes_upgrade_proposal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processesUpgradeProposal->load('process', 'status');

        return view('admin.processes-upgrade-proposal.show', compact('processesUpgradeProposal'));
    }

    public function __construct()
    {
        $this->csvImportModel = ProcessesUpgradeProposal::class;
    }
}
