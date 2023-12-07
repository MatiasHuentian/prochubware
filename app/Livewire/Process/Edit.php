<?php

namespace App\Http\Livewire\Process;

use App\Models\User;
use App\Models\Input;
use App\Models\Output;
use App\Models\Process;
use Livewire\Component;
use App\Models\Glossary;
use App\Models\Dependency;
use App\Models\RisksControl;
use App\Models\ProcessesState;
use App\Models\ObejctivesGroup;
use App\Models\RisksControlsType;
use App\Models\RisksControlsMethod;
use App\Models\ActivitiesRisksCause;
use App\Models\ActivitiesRisksImpact;
use App\Models\ActivitiesRisksPolitic;
use App\Models\RisksControlsFrecuency;
use App\Models\ActivitiesRisksConsequence;
use App\Models\ActivitiesRisksProbability;
use App\Models\AttachmentsCategory;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Process $process;

    public array $input = [];
    public array $inputs = [];

    public array $output = [];
    public array $outputs = [];

    public array $glosary = [];
    public array $glossaries = [];

    public array $objective_group = [];
    public array $objectives_groups = [];

    public array $listsForFields = [];

    public array $activities = [];

    public array $kpis = [];

    public array $attachments = [];

    public array $mediaCollections = [];

    public array $mediaToRemove = [];

    public function addMedia($media , $in = null ): void
    {
        if ($in === null) {
            $in = $media['model_id'];
        }
        $this->mediaCollections[$media['collection_name']][$in][] = $media;
    }

    public function removeMedia($media , $in = null): void
    {
        if ($in === null) {
            $in = $media['model_id'];
        }

        $collection = collect($this->mediaCollections[$media['collection_name']][$in]);
        // Collection está igual;
        $this->mediaCollections[$media['collection_name']][$in] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];

    }

    public function getMediaCollection($name)
    {
        dd($this->mediaCollections);
        return $this->mediaCollections[$name];
    }

    protected function syncMedia( $attachment ,  $in = null ): void
    {
        $collection = collect( collect($this->mediaCollections )->flatten(1)[$in] );

        $collection->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $attachment->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function pivot_many_format($data, $model)
    {
        $transformedData = [];
        $descriptions = [];
        foreach ($data as $item) {
            $transformedItem = [
                "id" => $item["id"],
                "name" => ($item["name"] ??  $item["term"]), // setear name, en caso de no existir name, que entonces term
                "description" => $item["pivot"]["description"],
                "descriptions" => $descriptions,
            ];

            $transformedData[] = $transformedItem;
        }

        // Resultado final
        return $transformedData;
    }

    public function mount(Process $process)
    {
        $this->process         = $process;

        $relations_many = [
            'glosary'         => $this->process->glosary,
            'input'           => $this->process->input,
            'output'          => $this->process->output,
            'objectiveGroup' => $this->process->objectiveGroup,
        ];

        $this->glosary         = $relations_many['glosary']->pluck('id')->toArray();
        $this->input           = $relations_many['input']->pluck('id')->toArray();
        $this->output          = $relations_many['output']->pluck('id')->toArray();
        $this->objective_group = $relations_many['objectiveGroup']->pluck('id')->toArray();

        $this->inputs = $this->pivot_many_format($relations_many['input'], new Input());
        $this->glossaries = $this->pivot_many_format($relations_many['glosary'], new Glossary());
        $this->outputs = $this->pivot_many_format($relations_many['output'], new Output());
        $this->objectives_groups = $this->pivot_many_format($relations_many['objectiveGroup'], new ObejctivesGroup());

        $this->process = $this->process->load(['kpis', 'attachments.media', 'activities' => function ($query) {
            return $query->with(['risks' => function ($query) {
                return $query->with(
                    'causes',
                    'consequences',
                    'controls'
                );
            }]);
        }]);

        $this->activities = $this->process->activities->toArray();

        $this->kpis = $this->process->kpis->toArray();

        $this->attachments = $this->process->attachments->toArray();
        foreach ($this->attachments as $index => $attachment) {
            $this->mediaCollections['attachment_src'][$index] = $attachment["src"];
        }

        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.process.edit');
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

        $this->process->attachments()->delete();
        foreach ($this->attachments as $i => $attachment) {
            $attachment_model = $this->process->attachments()->create($attachment);
            if ( collect($this->mediaCollections)->flatten(1)[$i] ?? false ){
                $this->syncMedia( $attachment_model , $i );
            }
        }

        $this->process->input()->sync(
            $this->refactor_many_to_many($this->inputs, new Input())
        );

        foreach ($this->glossaries as &$item) {
            $item['term'] = $item['name'];
            unset($item['name']);
        }

        $this->process->glosary()->sync(
            $this->refactor_many_to_many($this->glossaries, new Glossary())
        );
        $this->process->output()->sync(
            $this->refactor_many_to_many($this->outputs, new Output())
        );
        $this->process->objectiveGroup()->sync(
            $this->refactor_many_to_many($this->objectives_groups, new ObejctivesGroup())
        );
        $this->process->activities()->delete();
        foreach ($this->activities as $activity) {
            $activities = $this->process->activities()->create($activity);

            $activities->risks()->delete();
            foreach ($activity['risks'] as $risk) {
                $activitiesRisk = $activities->risks()->create($risk);

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
        }

        $this->process->kpis()->delete();
        foreach ($this->kpis as $activity) {
            $kpis = $this->process->kpis()->create($activity);
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
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['owner']           = User::pluck('name', 'id')->toArray();
        $this->listsForFields['dependency']      = Dependency::pluck('name', 'id')->toArray();
        $this->listsForFields['state']           = ProcessesState::pluck('name', 'id')->toArray();
        $this->listsForFields['glosary']         = Glossary::pluck('term', 'id')->toArray();
        $this->listsForFields['input']           = Input::pluck('name', 'id')->toArray();
        $this->listsForFields['output']          = Output::pluck('name', 'id')->toArray();
        $this->listsForFields['objective_group'] = ObejctivesGroup::pluck('name', 'id')->toArray();

        $this->listsForFields['politic']            = ActivitiesRisksPolitic::pluck('name', 'id')->toArray();
        $this->listsForFields['probability']        = ActivitiesRisksProbability::pluck('name', 'id')->toArray();
        $this->listsForFields['impact']             = ActivitiesRisksImpact::pluck('name', 'id')->toArray();
        $this->listsForFields['frecuency']          = RisksControlsFrecuency::pluck('name', 'id')->toArray();
        $this->listsForFields['method']             = RisksControlsMethod::pluck('name', 'id')->toArray();
        $this->listsForFields['type']               = RisksControlsType::pluck('name', 'id')->toArray();

        $this->listsForFields['category']           = AttachmentsCategory::pluck('name', 'id')->toArray();
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
            // dd($model_explode);
            $this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model][] = [
                ['name' => '', 'description' => ""]
            ];
        } else {
            $notacionArray = $this->dotToArray($model); //$activities["0"]["risks"]["0"]["causes"]
            $this->{$notacionArray}[] = ['name' => '', 'description' => ""];
        }

        if ($model == 'attachments') {
            $last_id = array_key_last($this->attachments);
            $this->dispatchBrowserEvent('reApplyDropzone_' . $last_id);
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
            // dd($model_explode);
            unset($this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model][$index]);
            $this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model] = array_values($this->{$first_model}[$model_explode[1]][$model_explode[2]][$model_explode[3]][$last_model]);
        } else {
            unset($this->{$model}[$index]);
            $this->{$model} = array_values($this->{$model});
        }
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
}
