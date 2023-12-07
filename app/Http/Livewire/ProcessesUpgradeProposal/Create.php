<?php

namespace App\Http\Livewire\ProcessesUpgradeProposal;

use App\Models\Process;
use App\Models\ProcessesUpgradeProposal;
use App\Models\UpgradeProposalsState;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    public ProcessesUpgradeProposal $processesUpgradeProposal;

    public function mount(ProcessesUpgradeProposal $processesUpgradeProposal)
    {
        $this->processesUpgradeProposal = $processesUpgradeProposal;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.processes-upgrade-proposal.create');
    }

    public function submit()
    {
        $this->validate();

        $this->processesUpgradeProposal->save();

        return redirect()->route('admin.processes-upgrade-proposals.index');
    }

    protected function rules(): array
    {
        return [
            'processesUpgradeProposal.process_id' => [
                'integer',
                'exists:processes,id',
                'required',
            ],
            'processesUpgradeProposal.status_id' => [
                'integer',
                'exists:upgrade_proposals_states,id',
                'required',
            ],
            'processesUpgradeProposal.description' => [
                'string',
                'required',
            ],
            'processesUpgradeProposal.deadline' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['process'] = Process::pluck('name', 'id')->toArray();
        $this->listsForFields['status']  = UpgradeProposalsState::pluck('name', 'id')->toArray();
    }
}
