<?php

namespace App\Http\Livewire\ActivitiesRisk;

use Livewire\Component;
use App\Models\ActivitiesRisk;
use App\Models\ActivitiesRisksCause;
use App\Models\ProcessesActivity;
use App\Models\ActivitiesRisksImpact;
use App\Models\ActivitiesRisksPolitic;
use App\Models\ActivitiesRisksProbability;

class Clean extends Component
{
    public array $listsForFields = [];

    public ActivitiesRisk $activitiesRisk;

    public function mount(ActivitiesRisk $activitiesRisk)
    {
        $this->activitiesRisk = $activitiesRisk;
        $this->initListsForFields();
    }

    public function submit()
    {
        $this->validate();

        $this->activitiesRisk->save();

        foreach ($this->causes as $causeData) {
            // Evitar agregar causas vacías
            if (!empty($causeData['name'])) {
                $cause = new ActivitiesRisksCause($causeData);
                $this->activitiesRisk->causes()->save($cause);
            }
        }

        foreach ($this->consequences as $consequencesData) {
            // Evitar agregar causas vacías
            if (!empty($consequencesData['name'])) {
                $cause = new ActivitiesRisksCause($consequencesData);
                $this->activitiesRisk->consequences()->save($cause);
            }
        }

        return redirect()->route('admin.activities-risks.index');
    }

    public function render()
    {
        return view('livewire.activities-risk.clean');
    }

    protected function rules(): array
    {
        return [
            'activitiesRisk.activity_id' => [
                'integer',
                'exists:processes_activities,id',
                'required',
            ],
            'activitiesRisk.name' => [
                'string',
                'max:100',
                'required',
            ],
            'activitiesRisk.politic_id' => [
                'integer',
                'exists:activities_risks_politics,id',
                'nullable',
            ],
            'activitiesRisk.probability_id' => [
                'integer',
                'exists:activities_risks_probabilities,id',
                'required',
            ],
            'activitiesRisk.impact_id' => [
                'integer',
                'exists:activities_risks_impacts,id',
                'nullable',
            ],
            'activitiesRisk.description' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['activity']    = ProcessesActivity::pluck('name', 'id')->toArray();
        $this->listsForFields['politic']     = ActivitiesRisksPolitic::pluck('name', 'id')->toArray();
        $this->listsForFields['probability'] = ActivitiesRisksProbability::pluck('name', 'id')->toArray();
        $this->listsForFields['impact']      = ActivitiesRisksImpact::pluck('name', 'id')->toArray();
    }
}
