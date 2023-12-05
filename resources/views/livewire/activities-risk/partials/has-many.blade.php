@php
    $card_id = str_replace('.', '-', ($in ?? '') . ($list_name ?? ''));
@endphp
<div class="card">
    <div class="card-header-xs"
        onclick="show_hide('card-body-{{ $card_id }}' , 'arrow-collapsable-{{ $card_id }}')">
        {{ $name . ($plural_name ?? 's') }}
        <div class="card-icon-container">
            <i id="arrow-collapsable-{{ $card_id }}" class="fas fa-chevron-down card-icon rotate-0"></i>
        </div>
    </div>

    <div class="card-body-xs block" id="card-body-{{ $card_id }}">
        @foreach ($list as $index => $element)
            <div class="card mt-4">
                <div class="card-header">
                    <div class="flex items-center {{ $errors->has("$list_name.$index.name") ? 'invalid' : '' }}">
                        <label class="text-gray-600 pr-2"
                            for="{{ $list_name }}_{{ $index }}_name">{{ $name }}
                            N°{{ $index + 1 }}</label>
                        <input type="text" id="{{ $list_name }}_{{ $index }}_name"
                            class="w-full py-2 px-3 text-gray-700 border rounded focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-400"
                            wire:model.defer="{{ $list_name }}.{{ $index }}.name"
                            placeholder="Ingrese nombre de la {{ $name }}" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group {{ $errors->has("$list_name.$index.description") ? 'invalid' : '' }}">
                        <label class="form-label"
                            for="{{ $list_name }}_{{ $index }}_description">Descripción</label>
                        <textarea class="form-control" id="{{ $list_name }}_{{ $index }}_description"
                            wire:model.defer="{{ $list_name }}.{{ $index }}.description" rows="4"></textarea>
                        <div class="validation-message">
                            {{ $errors->first("$list_name.$index.description") }}
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
