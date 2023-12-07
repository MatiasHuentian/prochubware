<?php

namespace App\Http\Livewire\ActivitiesRisk;

use App\Models\ActivitiesRisk;
use App\Models\ActivitiesRisksCause;
use App\Models\ActivitiesRisksConsequence;
use App\Models\ActivitiesRisksImpact;
use App\Models\ActivitiesRisksPolitic;
use App\Models\ActivitiesRisksProbability;
use App\Models\ProcessesActivity;
use App\Models\RisksControl;
use App\Models\RisksControlsFrecuency;
use App\Models\RisksControlsMethod;
use App\Models\RisksControlsType;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];
    public ActivitiesRisk $activitiesRisk;
    public $causes = [];
    public $consequences = [];
    public $controls = [];

    public function mount(ActivitiesRisk $activitiesRisk)
    {
        $this->activitiesRisk = $activitiesRisk;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.activities-risk.create');
    }

    public function submit()
    {
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
                $consequences = new ActivitiesRisksConsequence($consequencesData);
                $this->activitiesRisk->consequences()->save($consequences);
            }
        }

        foreach ($this->controls as $controlsData) {
            // Evitar agregar causas vacías
            if (!empty($controlsData['name'])) {
                $controls = new RisksControl($controlsData);
                $this->activitiesRisk->controls()->save($controls);
            }
        }

        return redirect()->route('admin.activities-risks.index');
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
            'causes.*.name' => [
                'string',
                'max:255', // ajusta esto según tus requisitos
                'nullable',
            ],
            'causes.*.description' => [
                'string',
                'nullable',
            ],
            'consequences.*.name' => [
                'string',
                'max:255', // ajusta esto según tus requisitos
                'nullable',
            ],
            'consequences.*.description' => [
                'string',
                'nullable',
            ],
            'controls.*.name' => [
                'string',
                'max:255', // ajusta esto según tus requisitos
                'nullable',
            ],
            'controls.*.frecuency_id' => [
                'integer',
                'exists:risks_controls_frecuencies,id',
                'nullable',
            ],
            'controls.*.method_id' => [
                'integer',
                'exists:risks_controls_methods,id',
                'nullable',
            ],
            'controls.*.type_id' => [
                'integer',
                'exists:risks_controls_types,id',
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
        $this->listsForFields['frecuency'] = RisksControlsFrecuency::pluck('name', 'id')->toArray();
        $this->listsForFields['method']     = RisksControlsMethod::pluck('name', 'id')->toArray();
        $this->listsForFields['type']       = RisksControlsType::pluck('name', 'id')->toArray();
    }


    public function add_to_model($model)
    {
        if ($model == "test_model") {

        } else {
            $this->{$model}[] = ['name' => '', 'description' => ""];
        }
    }

    public function remove_to_model($model, $index)
    {
        if ($model == "test_model") {

        } else {
            unset($this->{$model}[$index]);
            $this->{$model} = array_values($this->{$model});
        }
    }
}
