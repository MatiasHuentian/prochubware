@php
    $singular_item = $singular_item;
    $plural_item = $plural_item;
@endphp
{{-- El select principal donde se elige el elemento --}}
<div class="form-group {{ $errors->has($singular_item) ? 'invalid' : '' }}">
    <label class="form-label" for="{{ $singular_item }}">{{ trans('cruds.process.fields.' . $singular_item) }}</label>
    <x-select-with-pivot class="form-control" id="{{ $singular_item }}" name="{{ $singular_item }}"
        wire:model="{{ $singular_item }}" :options="$this->listsForFields[$singular_item]" multiple :changefunction="'select_' . $singular_item" wire:key="{{ $singular_item }}" />
    <div class="validation-message">
        {{ $errors->first($singular_item) }}
    </div>
    <div class="help-block">
        {{ trans('cruds.process.fields.' . $singular_item . '_helper') }}
    </div>
</div>
<div class="form-group">
    @foreach ($items as $i => $item)
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <div class="flex flex-row items-center mb-2">
                    <label class="block w-1/4 text-gray-700 text-xs font-bold" for="grid-password">
                        {{ $item['name'] ?? 'name' }}
                    </label>
                    <div class="block w-1/2">
                        <x-select-list-v2 class="form-control"
                            id="{{ $plural_item }}-{{ $i }}-descriptions"
                            name="{{ $plural_item }}.{{ $i }}.descriptions"
                            wire:model="{{ $plural_item }}.{{ $i }}.description" :options="$item['descriptions']"
                            style="height: 2rem; padding-top: 0.3rem; padding-bottom: 0.3rem;" />
                    </div>
                </div>
                <textarea
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48"
                    name="description_{{ $i }}" id="description-{{ $i }}.{{ $plural_item }}"
                    wire:model.defer="{{ $plural_item }}.{{ $i }}.description" rows="4"></textarea>
            </div>
        </div>
    @endforeach
</div>
