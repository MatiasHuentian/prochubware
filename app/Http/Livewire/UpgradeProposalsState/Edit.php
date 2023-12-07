<?php

namespace App\Http\Livewire\UpgradeProposalsState;

use App\Models\UpgradeProposalsState;
use Livewire\Component;

class Edit extends Component
{
    public UpgradeProposalsState $upgradeProposalsState;

    public function mount(UpgradeProposalsState $upgradeProposalsState)
    {
        $this->upgradeProposalsState = $upgradeProposalsState;
    }

    public function render()
    {
        return view('livewire.upgrade-proposals-state.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->upgradeProposalsState->save();

        return redirect()->route('admin.upgrade-proposals-states.index');
    }

    protected function rules(): array
    {
        return [
            'upgradeProposalsState.name' => [
                'string',
                'max:100',
                'required',
            ],
            'upgradeProposalsState.color' => [
                'string',
                'min:6',
                'max:8',
                'required',
            ],
        ];
    }
}
