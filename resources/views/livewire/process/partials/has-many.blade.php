<div class="card">
    <div class="card-header">
        Actividades
    </div>

    <div class="card-body">
        @foreach ($activities as $index => $activity)
            <div class="card mt-4">
                <div class="card-header">
                    <div class="flex items-center {{ $errors->has("activities.$index.name") ? 'invalid' : '' }}">
                        <label class="text-gray-600 pr-2" for="activities[{{ $index }}][name]">Actividad</label>
                        <input type="text" name="activities[{{ $index }}][name]"
                            class="w-full py-2 px-3 text-gray-700 border rounded focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-400"
                            wire:model.defer="activities.{{ $index }}.name"
                            placeholder="Ingrese nombre de la actividad" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group {{ $errors->has("activities.$index.description") ? 'invalid' : '' }}">
                        <label class="form-label" for="activities[{{ $index }}][description]">Descripción</label>
                        <textarea class="form-control" name="activities[{{ $index }}][description]"
                            wire:model.defer="activities.{{ $index }}.description" rows="4"></textarea>
                        <div class="validation-message">
                            {{ $errors->first("activities.$index.description") }}
                        </div>
                    </div>
                    @foreach ($activity['activitiesRisks'] as $i => $risk)
                        @livewire('activities-risk.clean', ['activitiesRisk' => $risk['risk']], key( 'description-risk-'.$i.'-'.$index))
                    @endforeach
                    <button class="px-4 py-2 text-sm font-medium btn btn-indigo"
                        wire:click.prevent="addRisk({{ $index }})">+ Agregar
                        riesgo</button>
                </div>
                <div class="flex items-center m-2 {{ $errors->has("activities.$index.name") ? 'invalid' : '' }}">
                    <a href="#" class="btn btn-danger m-2"
                        wire:click.prevent="removeActivity({{ $index }})">Eliminar actividad</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        <button class="px-4 py-2 text-sm font-medium btn btn-indigo" wire:click.prevent="addActivity">+ Agregar otra
            actividad</button>
    </div>

</div>
</div>
