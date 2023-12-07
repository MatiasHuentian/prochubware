<?php

namespace App\Http\Livewire\ActivitiesRisksConsequence;

use App\Models\ActivitiesRisk;
use App\Models\ActivitiesRisksConsequence;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    public ActivitiesRisksConsequence $activitiesRisksConsequence;

    public function mount(ActivitiesRisksConsequence $activitiesRisksConsequence)
    {
        $this->activitiesRisksConsequence = $activitiesRisksConsequence;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.activities-risks-consequence.create');
    }

    public function submit()
    {
        $this->validate();

        $this->activitiesRisksConsequence->save();

        return redirect()->route('admin.activities-risks-consequences.index');
    }

    protected function rules(): array
    {
        return [
            'activitiesRisksConsequence.risk_id' => [
                'integer',
                'exists:activities_risks,id',
                'required',
            ],
            'activitiesRisksConsequence.name' => [
                'string',
                'max:100',
                'required',
            ],
            'activitiesRisksConsequence.description' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['risk'] = ActivitiesRisk::pluck('name', 'id')->toArray();
    }
}
