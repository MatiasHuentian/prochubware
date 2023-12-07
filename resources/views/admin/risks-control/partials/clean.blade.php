<div class="card">
    @php
        $card_id = str_replace('.', '-', ($in ?? '') . ($list_name ?? ''));
    @endphp
    <div class="card-header-xs"
        onclick="show_hide('card-body-{{ $card_id }}' , 'arrow-collapsable-{{ $card_id }}')">
        {{ $name . ($plural_name ?? 's') }}
        <div class="card-icon-container">
            <i id="arrow-collapsable-{{ $card_id }}"
                class="fas fa-chevron-down card-icon rotate-0"></i>
        </div>
    </div>

    <div class="card-body-xs block" id="card-body-{{ $card_id }}">
        @foreach ($list as $index => $element)
            <div class="card mt-4">
                <div class="card-header">
                    <div class="flex items-center {{ $errors->has("$list_name.$index.name") ? 'invalid' : '' }}">
                        <label class="text-gray-600 pr-2"
                            for="{{ $list_name }}[{{ $index }}][name]">{{ $name }}
                            N°{{ $index + 1 }}</label>
                        <input type="text" name="{{ $list_name }}[{{ $index }}][name]"
                            class="w-full py-2 px-3 text-gray-700 border rounded focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-400"
                            wire:model.defer="{{ $list_name }}.{{ $index }}.name"
                            placeholder="Ingrese nombre de la {{ $name }}" />
                    </div>
                </div>
                <div class="card-body">
                    <div
                        class="form-group {{ $errors->has($list_name . ".$index" . '.frecuency_id') ? 'invalid' : '' }}">
                        <label class="form-label"
                            for="frecuency">{{ trans('cruds.risksControl.fields.frecuency') }}</label>
                        <x-select-list-v3 class="form-control" id="{{ $list_name }}-{{ $index }}-frecuency"
                            modoEdicion="{{ $modoEdicion ?? false }}" name="frecuency" :options="$this->listsForFields['frecuency']"
                            wire:model="{{ $list_name }}.{{ $index }}.frecuency_id" />
                        <div class="validation-message">
                            {{ $errors->first($list_name . ".$index" . '.frecuency_id') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.risksControl.fields.frecuency_helper') }}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($list_name . ".$index" . '.method_id') ? 'invalid' : '' }}">
                        <label class="form-label"
                            for="method">{{ trans('cruds.risksControl.fields.method') }}</label>
                        <x-select-list-v3 class="form-control" id="{{ $list_name }}-{{ $index }}-method"
                            modoEdicion="{{ $modoEdicion ?? false }}" name="method" :options="$this->listsForFields['method']"
                            wire:model="{{ $list_name }}.{{ $index }}.method_id" />
                        <div class="validation-message">
                            {{ $errors->first($list_name . ".$index" . '.method_id') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.risksControl.fields.method_helper') }}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($list_name . ".$index" . '.type_id') ? 'invalid' : '' }}">
                        <label class="form-label" for="type">{{ trans('cruds.risksControl.fields.type') }}</label>
                        <x-select-list-v3 class="form-control" id="{{ $list_name }}-{{ $index }}-type"
                            modoEdicion="{{ $modoEdicion ?? false }}" name="type" :options="$this->listsForFields['type']"
                            wire:model="{{ $list_name }}.{{ $index }}.type_id"
                            placeholder="Seleccione tipo" />
                        <div class="validation-message">
                            {{ $errors->first($list_name . ".$index" . '.type_id') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.risksControl.fields.type_helper') }}
                        </div>
                    </div>
                </div>
                <div class="flex items-center m-2 {{ $errors->has("$list_name.$index.name") ? 'invalid' : '' }}">
                    <a href="#" class="btn btn-danger m-2"
                        wire:click.prevent="remove_to_model({{ "'" . $list_name . "'" . ',' . $index }})">Eliminar
                        {{ $name }}</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        <button class="px-4 py-2 text-sm font-medium btn btn-indigo"
            wire:click.prevent="add_to_model( '{{ $list_name }}' )">+ Agregar
            {{ $name }}</button>
    </div>
</div>
