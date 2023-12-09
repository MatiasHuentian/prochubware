<?php

namespace App\Http\Livewire\Process;

use App\Models\ActivitiesRisk;
use App\Models\ActivitiesRisksCause;
use App\Models\ActivitiesRisksConsequence;
use App\Models\User;
use App\Models\Input;
use App\Models\Output;
use App\Models\Process;
use Livewire\Component;
use App\Models\Glossary;
use App\Models\Dependency;
use App\Models\ProcessesState;
use App\Models\ObejctivesGroup;
use App\Models\RisksControlsType;
use App\Models\RisksControlsMethod;
use App\Models\ActivitiesRisksImpact;
use App\Models\ActivitiesRisksPolitic;
use App\Models\RisksControlsFrecuency;
use App\Models\ActivitiesRisksProbability;
use App\Models\AttachmentsCategory;
use App\Models\Direction;
use App\Models\RisksControl;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Process $process;

    // public array $test_arr = [];
    // public function addtest_array(){
    //     $this->test_arr[]=[];
    //     $last_id = array_key_last($this->test_arr);
    //     $this->dispatchBrowserEvent('reApplyDropzone_'.$last_id);
    // }

    public $directions;
    public $dependencies;
    public $selectedDirection;

    public array $input = [];
    public array $inputs = [];

    public array $output = [];
    public array $outputs = [];

    public array $glosary = [];
    public array $glossaries = [];

    public array $objective_group = [];
    public array $objectives_groups = [];

    public array $activities = [];

    public array $kpis = [];

    public array $attachments = [];

    public array $mediaToRemove = [];

    public array $mediaCollections = [];

    public array $listsForFields = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    protected function syncMedia( $attachment , $id = null ): void
    {
        collect($this->mediaCollections)->flatten(1)->where('model_id' , '=' , $id)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $attachment->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Process $process)
    {
        $this->process = $process;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.process.create');
    }

    private function refactor_many_to_many($collection, $model)
    {
        $syncData = [];
        foreach ($collection as $item) {
            $base_model = $model::firstOrCreate(['id' => $item['id']], ['id'  => null] + (Arr::except($item, ['id'])));
            $id = $base_model->id;
            $description = $item['description'];
            $syncData[$id] = ['description' => $description];
        }
        return $syncData;
    }

    public function submit()
    {
        $this->validate();
        $this->process->save();

        foreach ($this->attachments as $i => $attachment) {
            $attachment_model = $this->process->attachments()->create($attachment);
            if ( collect($this->mediaCollections)->flatten(1)[$i] ?? false ){
                $this->syncMedia( $attachment_model , $i);
            }
        }

        foreach ($this->glossaries as &$item) {
            $item['term'] = $item['name'];
            unset($item['name']);
        }

        $this->process->glosary()->sync(
            $this->refactor_many_to_many($this->glossaries, new Glossary())
        );


        $this->process->input()->sync(
            $this->refactor_many_to_many($this->inputs,  new Input() )
        );

        $this->process->output()->sync(
            $this->refactor_many_to_many($this->outputs, new Output())
        );

        $this->process->objectiveGroup()->sync(
            $this->refactor_many_to_many($this->objectives_groups, new ObejctivesGroup())
        );


        foreach ($this->kpis as $i => $kpi) {
            $this->process->kpis()->create($kpi);
        }

        foreach ($this->activities as $activity) {
            $activities = $this->process->activities()->create($activity);

            foreach ($activity['risks'] as $risk) {
                $activitiesRisk = $activities->risks()->create($risk);

                foreach (($risk['causes'] ?? []) as $causeData) {
                    // Evitar agregar causas vacías
                    if (!empty($causeData['name'])) {
                        $cause = new ActivitiesRisksCause($causeData);
                        $activitiesRisk->causes()->save($cause);
                    }
                }

                foreach (($risk['consequences'] ?? []) as $consequencesData) {
                    // Evitar agregar causas vacías
                    if (!empty($consequencesData['name'])) {
                        $consequences = new ActivitiesRisksConsequence($consequencesData);
                        $activitiesRisk->consequences()->save($consequences);
                    }
                }

                foreach (($risk['controls'] ?? []) as $controlsData) {
                    // Evitar agregar causas vacías
                    if (!empty($controlsData['name'])) {
                        $controls = new RisksControl($controlsData);
                        $activitiesRisk->controls()->save($controls);
                    }
                }
            }
        }

        return redirect()->route('admin.processes.index');
    }

    protected function rules(): array
    {
        return [
            'process.name' => [
                'string',
                'required',
            ],
            'process.owner_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'process.objective' => [
                'string',
                'nullable',
            ],
            'selectedDirection' => [
                'integer',
                'exists:directions,id',
                'required',
            ],
            'process.dependency_id' => [
                'integer',
                'exists:dependencies,id',
                'required',
            ],
            'process.state_id' => [
                'integer',
                'exists:processes_states,id',
                'required',
            ],
            'process.introduction' => [
                'string',
                'nullable',
            ],
            'process.contextual_memo' => [
                'string',
                'nullable',
            ],
            'process.start_date' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'process.end_date' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'glosary' => [
                'array',
            ],
            'glosary.*.id' => [
                'integer',
                'exists:glossaries,id',
            ],
            'input' => [
                'array',
            ],
            'input.*.id' => [
                'integer',
                'exists:inputs,id',
            ],
            'output' => [
                'array',
            ],
            'output.*.id' => [
                'integer',
                'exists:outputs,id',
            ],
            'objective_group' => [
                'array',
            ],
            'objective_group.*.id' => [
                'integer',
                'exists:obejctives_groups,id',
            ],
            'kpis' => [
                'array'
            ],
            'kpis.*.name' => [
                'string',
                'required'
            ],
            'kpis.*.name' => [
                'string',
                'required'
            ],
            'kpis.*.description' => [
                'string',
                'nullable'
            ],
            'kpis.*.calculate_form' => [
                'string',
                'nullable'
            ],
            'kpis.*.ubication_data' => [
                'string',
                'nullable'
            ],
            'attachments.*.mediaCollections.attachment_src' => [
                'array',
                'nullable',
            ],
            'attachments.*.mediaCollections.attachment_src.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'attachments.*.mediaCollections.attachment_src.*.mime_type' => [
                'string',
                Rule::in([
                    'text/plain',
                    'text/html',
                    'text/css',
                    // ... otras opciones ...
                    'application/pdf',
                    'application/zip',
                    'application/json',
                    'application/xml',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    // ... otras opciones ...
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    // ... otras opciones ...
                    'audio/mpeg',
                    'audio/wav',
                    'audio/ogg',
                    // ... otras opciones ...
                    'video/mp4',
                    'video/webm',
                    'video/ogg',
                    // ... otras opciones ...
                ]),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['owner']              = User::pluck('name', 'id')->toArray();
        $this->listsForFields['state']              = ProcessesState::pluck('name', 'id')->toArray();
        $this->listsForFields['glosaries']          = Glossary::with('processes')->get();
        $this->listsForFields['glosary']            = $this->listsForFields['glosaries']->pluck('term', 'id')->toArray();

        $this->listsForFields['inputs']             = Input::with('processes')->get();
        $this->listsForFields['input']              = $this->listsForFields['inputs']->pluck('name', 'id')->toArray();

        $this->listsForFields['outputs']            = Output::with('processes')->get();
        $this->listsForFields['output']             = $this->listsForFields['outputs']->pluck('name', 'id')->toArray();

        $this->listsForFields['objectives_groups']  = ObejctivesGroup::with('processes')->get();
        $this->listsForFields['objective_group']    = $this->listsForFields['objectives_groups']->pluck('name', 'id')->toArray();

        $this->listsForFields['politic']            = ActivitiesRisksPolitic::pluck('name', 'id')->toArray();
        $this->listsForFields['probability']        = ActivitiesRisksProbability::pluck('name', 'id')->toArray();
        $this->listsForFields['impact']             = ActivitiesRisksImpact::pluck('name', 'id')->toArray();
        $this->listsForFields['frecuency']          = RisksControlsFrecuency::pluck('name', 'id')->toArray();
        $this->listsForFields['method']             = RisksControlsMethod::pluck('name', 'id')->toArray();
        $this->listsForFields['type']               = RisksControlsType::pluck('name', 'id')->toArray();

        $this->listsForFields['category']           = AttachmentsCategory::pluck('name', 'id')->toArray();

        $this->listsForFields['direction']           = Direction::pluck('name', 'id')->toArray();
        $this->listsForFields['dependency']           = "";
    }

    public function updatedSelectedDirection($direction)
    {
        $this->listsForFields['dependency'] = Dependency::where('direction_id' , '=' , $direction)->pluck('name' , 'id')->toArray();
        // $this->selectedDe = $direction;
    }

    public function select_glosary()
    {
        // Filtrar $glossaries
        $glossaries = array_filter($this->glossaries, function ($glossary) {
            return in_array($glossary['id'], $this->glosary);
        });

        // Crear elementos faltantes
        $existingIds = array_column($this->glossaries, 'id');
        $missingIds = array_diff($this->glosary, $existingIds);
        $descriptions = [];
        foreach ($missingIds as $missingId) {
            if ($this->listsForFields['glosary'][$missingId] ?? false) {
                // En caso de que exista el id
                $name = $this->listsForFields['glosary'][$missingId];
                $descriptions = Glossary::with('processes')->find($missingId)
                    ->processes
                    ->unique() // Filtra descripciones únicas
                    ->mapWithKeys(function ($process) {
                        return [$process->pivot->description => $process->pivot->description];
                    })
                    ->toArray();
            } else {
                // en caso de que no exista el id
                array_push($this->listsForFields['glosary'],  $missingId);
                $name = $missingId;
                $missingId =  $missingId;
            }

            $glossaries[] = [
                'id' => $missingId,
                'name' => $name,
                'description' => "",
                'descriptions' => $descriptions,
            ];
        }

        $this->glossaries = $glossaries;
        $this->dispatchBrowserEvent('apply_select2');
    }

    public function select_input()
    {
        // Filtrar $inputs
        $inputs = array_filter($this->inputs, function ($input) {
            return in_array($input['id'], $this->input);
        });

        // Crear elementos faltantes
        $existingIds = array_column($this->inputs, 'id');
        $missingIds = array_diff($this->input, $existingIds);
        $descriptions = [];
        foreach ($missingIds as $missingId) {
            if ($this->listsForFields['input'][$missingId] ?? false) {
                // En caso de que exista el id
                $name = $this->listsForFields['input'][$missingId];
                $descriptions = Input::with('processes')->find($missingId)
                    ->processes
                    ->unique() // Filtra descripciones únicas
                    ->mapWithKeys(function ($process) {
                        return [$process->pivot->description => $process->pivot->description];
                    })
                    ->toArray();
            } else {
                // en caso de que no exista el id
                array_push($this->listsForFields['input'],  $missingId);
                $name = $missingId;
                $missingId =  $missingId;
            }

            $inputs[] = [
                'id' => $missingId,
                'name' => $name,
                'description' => "",
                'descriptions' => $descriptions,
            ];
        }

        $this->inputs = $inputs;
        $this->dispatchBrowserEvent('apply_select2');
    }

    public function select_output()
    {
        // Filtrar $outputs
        $outputs = array_filter($this->outputs, function ($output) {
            return in_array($output['id'], $this->output);
        });

        // Crear elementos faltantes
        $existingIds = array_column($this->outputs, 'id');
        $missingIds = array_diff($this->output, $existingIds);
        $descriptions = [];
        foreach ($missingIds as $missingId) {
            if ($this->listsForFields['output'][$missingId] ?? false) {
                // En caso de que exista el id
                $name = $this->listsForFields['output'][$missingId];
                $descriptions = output::with('processes')->find($missingId)
                    ->processes
                    ->unique() // Filtra descripciones únicas
                    ->mapWithKeys(function ($process) {
                        return [$process->pivot->description => $process->pivot->description];
                    })
                    ->toArray();
            } else {
                // en caso de que no exista el id
                array_push($this->listsForFields['output'],  $missingId);
                $name = $missingId;
                $missingId =  $missingId;
            }

            $outputs[] = [
                'id' => $missingId,
                'name' => $name,
                'description' => "",
                'descriptions' => $descriptions,
            ];
        }

        $this->outputs = $outputs;
        $this->dispatchBrowserEvent('apply_select2');
    }

    public function select_objective_group()
    {
        // Filtrar $objectives_groups
        $objectives_groups = array_filter($this->objectives_groups, function ($objective_group) {
            return in_array($objective_group['id'], $this->objective_group);
        });

        // Crear elementos faltantes
        $existingIds = array_column($this->objectives_groups, 'id');
        $missingIds = array_diff($this->objective_group, $existingIds);
        $descriptions = [];
        foreach ($missingIds as $missingId) {
            if ($this->listsForFields['objective_group'][$missingId] ?? false) {
                // En caso de que exista el id
                $name = $this->listsForFields['objective_group'][$missingId];
                $descriptions = ObejctivesGroup::with('processes')->find($missingId)
                    ->processes
                    ->unique() // Filtra descripciones únicas
                    ->mapWithKeys(function ($process) {
                        return [$process->pivot->description => $process->pivot->description];
                    })
                    ->toArray();
            } else {
                // en caso de que no exista el id
                array_push($this->listsForFields['objective_group'],  $missingId);
                $name = $missingId;
                $missingId =  $missingId;
            }

            $objectives_groups[] = [
                'id' => $missingId,
                'name' => $name,
                'description' => "",
                'descriptions' => $descriptions,
            ];
        }

        $this->objectives_groups = $objectives_groups;
        $this->dispatchBrowserEvent('apply_select2');
    }

    protected function contiene_palabra(string $cadena, string $palabra): bool
    {
        return strpos($cadena, $palabra) !== false;
    }

    /**
     * Convierte una notación de puntos en una representación de array en PHP.
     *
     * @param string $notacion La cadena en notación de puntos a convertir.
     * @return string La cadena en notación de array resultante.
     */
    function dotToArray($notacion)
    {
        $containsDot = strpos($notacion, '.') !== false;
        if ($containsDot) {
            $segmentos = explode('.', $notacion);
            $resultado = '';

            foreach ($segmentos as $index => $segmento) {
                if ($index % 2 == 0) {
                    $resultado .= ($index > 1 ? '"]["' : '') . $segmento;
                } else {
                    $resultado .= ($index != 1 ? '"]["' : '["') . $segmento;
                }
            }
            $resultado = $resultado . '"]'; // Terminando uniendo el array
        } else {
            $resultado = $notacion;
        }
        return $resultado;
    }

    public function add_to_model($model)
    {
        // Busco si contiene las palabras claves activities al mismo tiempo
        $containsActivities = preg_match('/\bactivitiesRisk\b/', $model);
        $containsDot = strpos($model, '.') !== false;

        if (count($model_explode = explode('.', $model)) == 3 and (
            ($containsActivities and $containsDot) || ($this->contiene_palabra($model, "activities") &&
                $this->contiene_palabra($model, "risks"))
        )) {
            $model_explode = explode('.', $model);
            $last_model =  end($model_explode);
            $first_model =  $model_explode[0];
            $this->{$first_model}[$model_explode[1]][$last_model][] =
                ['name' => '', 'description' => ""];
        } else if ($this->contiene_palabra($model, "activities.") && $this->contiene_palabra($model, 'risks.')) {
            $model_explode = explode('.', $model);
            $last_model =  end($model_explode);
            $first_model =  $model_explode[0];
            $this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model][] = [
                ['name' => '', 'description' => ""]
            ];
        } else {
            $notacionArray = $this->dotToArray($model); //$activities["0"]["risks"]["0"]["causes"]
            $this->{$notacionArray}[] = ['name' => '', 'description' => ""];
        }

        if($model == 'attachments'){
            $last_id = array_key_last($this->attachments);
            $this->dispatchBrowserEvent('reApplyDropzone_'.$last_id);
        }
    }

    public function remove_to_model($model, $index)
    {
        $containsActivities = preg_match('/\bactivitiesRisk\b/', $model);
        $containsDot = strpos($model, '.') !== false;

        if (count($model_explode = explode('.', $model)) == 3 and (
            ($containsActivities and $containsDot) || ($this->contiene_palabra($model, "activities") &&
                $this->contiene_palabra($model, "risks"))
        )) {
            $model_explode = explode('.', $model);
            $last_model =  end($model_explode);
            $first_model =  $model_explode[0];
            unset($this->{$first_model}[$model_explode[1]][$last_model][$index]);
            $this->{$first_model}[$model_explode[1]][$last_model] = array_values($this->{$first_model}[$model_explode[1]][$last_model]);
        } else if ($this->contiene_palabra($model, "activities.") && $this->contiene_palabra($model, 'risks.')) {
            $model_explode = explode('.', $model);
            $last_model =  end($model_explode);
            $first_model =  $model_explode[0];
            unset($this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model][$index]);
            $this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model] = array_values($this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model]);
        } else {
            unset($this->{$model}[$index]);
            $this->{$model} = array_values($this->{$model});
        }
    }
}
