<?php

namespace App\Http\Livewire\ProcessesActivity;

use App\Models\ActivitiesRisksCause;
use App\Models\ActivitiesRisksConsequence;
use App\Models\Process;
use Livewire\Component;
use App\Models\ProcessesActivity;
use App\Models\RisksControlsType;
use App\Models\RisksControlsMethod;
use App\Models\ActivitiesRisksImpact;
use App\Models\ActivitiesRisksPolitic;
use App\Models\RisksControlsFrecuency;
use App\Models\ActivitiesRisksProbability;
use App\Models\RisksControl;

class Edit extends Component
{
    public array $listsForFields = [];

    public ProcessesActivity $processesActivity;
    public $activitiesRisk = [];

    public function mount(ProcessesActivity $processesActivity)
    {
        $this->processesActivity = $processesActivity->load(['risks' => function ($query) {
            return $query->with(
                'causes',
                'consequences',
                'controls'
            );
        }]);
        $this->activitiesRisk = $this->processesActivity->risks->toArray();

        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.processes-activity.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->processesActivity->save();
        $this->processesActivity->risks()->delete();
        foreach ($this->activitiesRisk as $risk) {
            $activitiesRisk = $this->processesActivity->risks()->create($risk);

            $activitiesRisk->causes()->delete();
            foreach (($risk['causes'] ?? []) as $causeData) {
                // Evitar agregar causas vacías
                if (!empty($causeData['name'])) {
                    $cause = new ActivitiesRisksCause($causeData);
                    $activitiesRisk->causes()->save($cause);
                }
            }

            $activitiesRisk->consequences()->delete();
            foreach (($risk['consequences'] ?? []) as $consequencesData) {
                // Evitar agregar causas vacías
                if (!empty($consequencesData['name'])) {
                    $consequences = new ActivitiesRisksConsequence($consequencesData);
                    $activitiesRisk->consequences()->save($consequences);
                }
            }

            $activitiesRisk->controls()->delete();
            foreach (($risk['controls'] ?? []) as $controlsData) {
                // Evitar agregar causas vacías
                if (!empty($controlsData['name'])) {
                    $controls = new RisksControl($controlsData);
                    $activitiesRisk->controls()->save($controls);
                }
            }
        }
        return redirect()->route('admin.processes-activities.index');
    }

    protected function rules(): array
    {
        return [
            'processesActivity.name' => [
                'string',
                'max:100',
                'required',
            ],
            'processesActivity.process_id' => [
                'integer',
                'exists:processes,id',
                'required',
            ],
            'processesActivity.description' => [
                'string',
                'required',
            ],
            'activitiesRisk.*.name' => [
                'string',
                'max:100',
                'required',
            ],
            'activitiesRisk.*.politic_id' => [
                'integer',
                'exists:activities_risks_politics,id',
                'nullable',
            ],
            'activitiesRisk.*.probability_id' => [
                'integer',
                'exists:activities_risks_probabilities,id',
                'required',
            ],
            'activitiesRisk.*.impact_id' => [
                'integer',
                'exists:activities_risks_impacts,id',
                'nullable',
            ],
            'activitiesRisk.*.description' => [
                'string',
                'nullable',
            ],

            'activitiesRisk.*.causes.*.name' => [
                'string',
                'max:255', // ajusta esto según tus requisitos
                'nullable',
            ],
            'activitiesRisk.*.causes.*.description' => [
                'string',
                'nullable',
            ],
            'activitiesRisk.*.consequences.*.name' => [
                'string',
                'max:255', // ajusta esto según tus requisitos
                'nullable',
            ],
            'activitiesRisk.*.consequences.*.description' => [
                'string',
                'nullable',
            ],
            'activitiesRisk.*.controls.*.name' => [
                'string',
                'max:255', // ajusta esto según tus requisitos
                'nullable',
            ],
            'activitiesRisk.*.controls.*.frecuency_id' => [
                'integer',
                'exists:risks_controls_frecuencies,id',
                'nullable',
            ],
            'activitiesRisk.*.controls.*.method_id' => [
                'integer',
                'exists:risks_controls_methods,id',
                'nullable',
            ],
            'activitiesRisk.*.controls.*.type_id' => [
                'integer',
                'exists:risks_controls_types,id',
                'nullable',
            ],
        ];
    }

    public function add_to_model($model)
    {
        // Busco si contiene las palabras claves activities al mismo tiempo
        $containsActivities = preg_match('/\bactivitiesRisk\b/', $model);
        $containsDot = strpos($model, '.') !== false;

        if ($containsActivities and $containsDot) {
            $model_explode = explode('.', $model);
            $last_model =  end($model_explode);
            $first_model =  $model_explode[0];
            $this->{$first_model}[$model_explode[1]][$last_model][] = [
                ['name' => '', 'description' => ""]
            ];
        } else {
            $this->{$model}[] = ['name' => '', 'description' => ""];
        }
    }

    public function remove_to_model($model, $index)
    {
        $containsActivities = preg_match('/\bactivitiesRisk\b/', $model);
        $containsDot = strpos($model, '.') !== false;

        if ($containsActivities and $containsDot) {
            $model_explode = explode('.', $model);
            $last_model =  end($model_explode);
            $first_model =  $model_explode[0];
            unset($this->{$first_model}[$model_explode[1]][$last_model][$index]);
            $this->{$first_model}[$model_explode[1]][$last_model] = array_values($this->{$first_model}[$model_explode[1]][$last_model]);
        } else {
            unset($this->{$model}[$index]);
            $this->{$model} = array_values($this->{$model});
        }
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['process'] = Process::pluck('name', 'id')->toArray();
        $this->listsForFields['politic']     = ActivitiesRisksPolitic::pluck('name', 'id')->toArray();
        $this->listsForFields['probability'] = ActivitiesRisksProbability::pluck('name', 'id')->toArray();
        $this->listsForFields['impact']      = ActivitiesRisksImpact::pluck('name', 'id')->toArray();
        $this->listsForFields['frecuency'] = RisksControlsFrecuency::pluck('name', 'id')->toArray();
        $this->listsForFields['method']     = RisksControlsMethod::pluck('name', 'id')->toArray();
        $this->listsForFields['type']       = RisksControlsType::pluck('name', 'id')->toArray();
    }
}
