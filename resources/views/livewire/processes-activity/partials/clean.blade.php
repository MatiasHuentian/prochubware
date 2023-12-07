<div class="form-group {{ $errors->has(($clean_model ?? 'processesActivity') . '.description') ? 'invalid' : '' }}">
    <label class="form-label required"
        for="{{ $clean_model ?? 'processesActivity' }}_description">{{ trans('cruds.processesActivity.fields.description') }}</label>
    <textarea class="form-control" id="{{ $clean_model ?? 'processesActivity' }}_description" required
        wire:model.defer="{{ $clean_model ?? 'processesActivity' }}.description" rows="4"></textarea>
    <div class="validation-message">
        {{ $errors->first(($clean_model ?? 'processesActivity') . '.description') }}
    </div>
    <div class="help-block">
        {{ trans('cruds.processesActivity.fields.description_helper') }}
    </div>
</div>

<div class="card">
    @php
        $card_id = str_replace('.', '-', ($in ?? '') . ($list_name ?? ''));
    @endphp
    <div class="card-header"
        onclick="show_hide('card-body-{{ $card_id }}' , 'arrow-collapsable-{{ $card_id }}')">
        {{ $name . ($plural_name ?? 's') }}
        <div class="card-icon-container">
            <i id="arrow-collapsable-{{ $card_id }}"
                class="fas fa-chevron-down card-icon rotate-0"></i>
        </div>
    </div>

    <div class="card-body-xs block" id="card-body-{{ $card_id }}">
        @php
            if (isset($personal_list)) {
                $list = ${$personal_list}[$in]['risks'] ?? [];
            }
        @endphp
        @foreach ($list as $index => $element)
            <div class="card mt-4">
                <div class="card-header-xs">
                    <div class="flex items-center {{ $errors->has("$list_name.$index.name") ? 'invalid' : '' }}">
                        <label class="text-gray-600 pr-2"
                            for="{{ $list_name }}_{{ $index }}_name">{{ $name }}
                            N°{{ $index + 1 }}</label>
                        <input type="text"
                            class="w-full py-2 px-3 text-gray-700 border rounded focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-400"
                            wire:model.defer="{{ $list_name }}.{{ $index }}.name"
                            id="{{ $list_name }}_{{ $index }}_name"
                            placeholder="Ingrese nombre de la {{ $name }}" />
                    </div>
                </div>
                <div class="card-body-xs">
                    @include('livewire.activities-risk.clean', [
                        'clean_model' => "$list_name.$index",
                        'personal_list' => $list_name,
                    ])
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
