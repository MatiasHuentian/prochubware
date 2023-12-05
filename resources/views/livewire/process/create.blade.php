<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('process.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.process.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" wire:model.defer="process.name">
        <div class="validation-message">
            {{ $errors->first('process.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.owner_id') ? 'invalid' : '' }}">
        <label class="form-label" for="owner">{{ trans('cruds.process.fields.owner') }}</label>
        <x-select-list class="form-control" id="owner" name="owner" :options="$this->listsForFields['owner']"
            wire:model="process.owner_id" />
        <div class="validation-message">
            {{ $errors->first('process.owner_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.owner_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.objective') ? 'invalid' : '' }}">
        <label class="form-label" for="objective">{{ trans('cruds.process.fields.objective') }}</label>
        <textarea class="form-control" name="objective" id="objective" wire:model.defer="process.objective" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('process.objective') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.objective_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.dependency_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="dependency">{{ trans('cruds.process.fields.dependency') }}</label>
        <x-select-list class="form-control" required id="dependency" name="dependency" :options="$this->listsForFields['dependency']"
            wire:model="process.dependency_id" />
        <div class="validation-message">
            {{ $errors->first('process.dependency_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.dependency_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.state_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="state">{{ trans('cruds.process.fields.state') }}</label>
        <x-select-list class="form-control" required id="state" name="state" :options="$this->listsForFields['state']"
            wire:model="process.state_id" />
        <div class="validation-message">
            {{ $errors->first('process.state_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.state_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.introduction') ? 'invalid' : '' }}">
        <label class="form-label" for="introduction">{{ trans('cruds.process.fields.introduction') }}</label>
        <textarea class="form-control" name="introduction" id="introduction" wire:model.defer="process.introduction"
            rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('process.introduction') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.introduction_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.contextual_memo') ? 'invalid' : '' }}">
        <label class="form-label" for="contextual_memo">{{ trans('cruds.process.fields.contextual_memo') }}</label>
        <textarea class="form-control" name="contextual_memo" id="contextual_memo" wire:model.defer="process.contextual_memo"
            rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('process.contextual_memo') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.contextual_memo_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.start_date') ? 'invalid' : '' }}">
        <label class="form-label" for="start_date">{{ trans('cruds.process.fields.start_date') }}</label>
        <x-date-picker class="form-control" wire:model="process.start_date" id="start_date" name="start_date"
            picker="date" />
        <div class="validation-message">
            {{ $errors->first('process.start_date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.start_date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('process.end_date') ? 'invalid' : '' }}">
        <label class="form-label" for="end_date">{{ trans('cruds.process.fields.end_date') }}</label>
        <x-date-picker class="form-control" wire:model="process.end_date" id="end_date" name="end_date"
            picker="date" />
        <div class="validation-message">
            {{ $errors->first('process.end_date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.process.fields.end_date_helper') }}
        </div>
    </div>

    @include('livewire.process.partials.pivot-select', [
        'singular_item' => 'glosary',
        'plural_item' => 'glossaries',
        'items' => $this->glossaries,
    ])

    @include('livewire.process.partials.pivot-select', [
        'singular_item' => 'input',
        'plural_item' => 'inputs',
        'items' => $this->inputs,
    ])

    @include('livewire.process.partials.pivot-select', [
        'singular_item' => 'output',
        'plural_item' => 'outputs',
        'items' => $this->outputs,
    ])

    @include('livewire.process.partials.pivot-select', [
        'singular_item' => 'objective_group',
        'plural_item' => 'objectives_groups',
        'items' => $this->objectives_groups,
    ])
    @php
        $name = 'KPI';
        $plural_name = '\'S';
        $list = $kpis;
        $list_name = 'kpis';
    @endphp

    <div class="card-xs">
        @php
            $card_id = str_replace('.', '-', ($in ?? '') . ($list_name ?? ''));
        @endphp
        <div class="card-header-xs"
            onclick="show_hide('card-body-{{ $card_id }}' , 'arrow-collapsable-{{ $card_id }}')">
            {{ $name . ($plural_name ?? 's') }}
            <div class="card-icon-container">
                <i id="arrow-collapsable-{{ $card_id }}" class="fas fa-chevron-down card-icon rotate-0"></i>
            </div>
        </div>

        <div class="card-body-xs block" id="card-body-{{ $card_id }}">
            @foreach ($list as $in => $item)
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="flex items-center {{ $errors->has("$list_name.$in.name") ? 'invalid' : '' }}">
                            <label class="text-gray-600 pr-2"
                                for="{{ $list_name }}_{{ $in }}_name">{{ $name }}
                                N°{{ $in + 1 }}</label>
                            <input type="text"
                                class="w-full py-2 px-3 text-gray-700 border rounded focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-400"
                                wire:model.defer="{{ $list_name }}.{{ $in }}.name"
                                id="{{ $list_name }}_{{ $in }}_name"
                                placeholder="Ingrese nombre de la {{ $name }}" />
                        </div>
                    </div>
                    <div class="card-body-xs">
                        @include('livewire.processes-kpi.partials.clean', [
                            'aditional_name' => ' KPI',
                            'list_name' => "kpis.$in",
                        ])
                    </div>
                    <div class="flex items-center m-2 {{ $errors->has("$list_name.$in.name") ? 'invalid' : '' }}">
                        <a href="#" class="btn btn-danger m-2"
                            wire:click.prevent="remove_to_model({{ '"' . $list_name . '"' . ',' . $in }})">Eliminar
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
    @include('livewire.process.partials.clean')
    @php
        $name = 'actividad';
        $plural_name = 'es';
        $list = $activities;
        $list_name = 'activities';
    @endphp

    <div class="card-xs">
        @php
            $card_id = str_replace('.', '-', ($in ?? '') . ($list_name ?? ''));
        @endphp
        <div class="card-header-xs"
            onclick="show_hide('card-body-{{ $card_id }}' , 'arrow-collapsable-{{ $card_id }}')">
            {{ $name . ($plural_name ?? 's') }}
            <div class="card-icon-container">
                <i id="arrow-collapsable-{{ $card_id }}" class="fas fa-chevron-down card-icon rotate-0"></i>
            </div>
        </div>

        <div class="card-body-xs block" id="card-body-{{ $card_id }}">
            @foreach ($list as $in => $activity)
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="flex items-center {{ $errors->has("$list_name.$in.name") ? 'invalid' : '' }}">
                            <label class="text-gray-600 pr-2"
                                for="{{ $list_name }}_{{ $in }}_name">{{ $name }}
                                N°{{ $in + 1 }}</label>
                            <input type="text"
                                class="w-full py-2 px-3 text-gray-700 border rounded focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-400"
                                wire:model.defer="{{ $list_name }}.{{ $in }}.name"
                                id="{{ $list_name }}_{{ $in }}_name"
                                placeholder="Ingrese nombre de la {{ $name }}" />
                        </div>
                    </div>
                    <div class="card-body-xs">
                        @include('livewire.processes-activity.partials.clean', [
                            'name' => 'Riesgo',
                            'plural_name' => 's',
                            'list' => $activity['risks'] ?? [],
                            'list_name' => "activities.$in.risks",
                            'clean_model' => "activities.$in",
                            'personal_list' => 'activities',
                        ])
                    </div>
                    <div class="flex items-center m-2 {{ $errors->has("$list_name.$in.name") ? 'invalid' : '' }}">
                        <a href="#" class="btn btn-danger m-2"
                            wire:click.prevent="remove_to_model({{ '"' . $list_name . '"' . ',' . $in }})">Eliminar
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

    @php
        $name = 'archivo adjunto';
        $plural_name = null;
        $list = $attachments;
        $list_name = 'attachments';
    @endphp
    <div class="card-xs">
        @php
            $card_id = str_replace('.', '-', ($in ?? '') . ($list_name ?? ''));
        @endphp
        <div class="card-header-xs"
            onclick="show_hide('card-body-{{ $card_id }}' , 'arrow-collapsable-{{ $card_id }}')">
            {{ $name . ($plural_name ?? 's') }}
            <div class="card-icon-container">
                <i id="arrow-collapsable-{{ $card_id }}" class="fas fa-chevron-down card-icon rotate-0"></i>
            </div>
        </div>
        <div class="card-body-xs block" id="card-body-{{ $card_id }}">
            @foreach ($list as $in => $attach)
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="flex items-center {{ $errors->has("$list_name.$in.name") ? 'invalid' : '' }}">
                            <label class="text-gray-600 pr-2"
                                for="{{ $list_name }}_{{ $in }}_name">{{ $name }}
                                N°{{ $in + 1 }}</label>
                        </div>
                        <div class="form-group {{ $errors->has("$list_name.$in.category_id") ? 'invalid' : '' }}">
                            <label class="form-label required"
                                for="{{ $list_name }}_{{ $in }}_category_id">{{ trans('cruds.attachment.fields.category') }}</label>
                            <x-select-list class="form-control" required
                                id="{{ $list_name }}_{{ $in }}_category_id"
                                name="{{ $list_name }}[{{ $in }}]['category']" :options="$this->listsForFields['category']"
                                wire:model="{{ $list_name }}.{{ $in }}.category_id" />
                            <div class="validation-message">
                                {{ $errors->first("$list_name.$in.category_id") }}
                            </div>
                            <div class="help-block">
                                {{ trans('cruds.attachment.fields.category_helper') }}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has("$list_name.$in.description") ? 'invalid' : '' }}">
                            <label class="form-label"
                                for="{{ $list_name }}_{{ $in }}_description">{{ trans('cruds.attachment.fields.description') }}</label>
                            <textarea class="form-control" name="{{ $list_name }}[{{ $in }}]['description']"
                                id="{{ $list_name }}_{{ $in }}_description"
                                wire:model.defer="{{ $list_name }}.{{ $in }}.description" rows="4"></textarea>
                            <div class="validation-message">
                                {{ $errors->first("$list_name.$in.description") }}
                            </div>
                            <div class="help-block">
                                {{ trans('cruds.attachment.fields.description_helper') }}
                            </div>
                        </div>
                        <div
                            class="form-group {{ $errors->has("$list_name.$in.mediaCollections.attachment_src") ? 'invalid' : '' }}">
                            <label class="form-label"
                                for="src">{{ trans('cruds.attachment.fields.src') }}</label>
                            <x-dropzone-v2 id="{{ $list_name }}_{{ $in }}_src"
                                name="{{ $list_name }}[{{ $in }}]['src']"
                                action="{{ route('admin.attachments.storeMedia') }}"
                                collection-name="attachment_src" max-file-size="2" max-files="1"
                                model-id="{{ $in }}" in="{{ $in }}" />
                            <div class="validation-message">
                                {{ $errors->first("$list_name.$in.mediaCollections.attachment_src") }}
                            </div>
                            <div class="help-block">
                                {{ trans('cruds.attachment.fields.src_helper') }}
                            </div>
                        </div>
                        {{-- <div class="form-group {{ $errors->has("$list_name.$in.mediaCollections.attachment_src") ? 'invalid' : '' }}">
                            <label class="form-label" for="src">{{ trans('cruds.attachment.fields.src') }}</label>
                            <x-dropzone id="{{ $list_name }}_{{ $in }}_src" name="{{ $list_name }}[{{ $in }}]['src']" action="{{ route('admin.attachments.storeMedia') }}" collection-name="attachment_src" max-file-size="2" max-files="1" />
                            <div class="validation-message">
                                {{ $errors->first("$list_name.$in.mediaCollections.attachment_src") }}
                            </div>
                            <div class="help-block">
                                {{ trans('cruds.attachment.fields.src_helper') }}
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="flex items-center m-2 {{ $errors->has("$list_name.$in.name") ? 'invalid' : '' }}">
                    <a href="#" class="btn btn-danger m-2"
                        wire:click.prevent="remove_to_model({{ '"' . $list_name . '"' . ',' . $in }})">Eliminar
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


    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.processes.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>


    {{-- @foreach ($test_arr as $in => $attach)
        @php
            $name = 'archivo adjunto';
            $plural_name = null;
            $list = $attachments;
            $list_name = 'attachments';
            // $in = 0;
        @endphp

        <div class="card mt-4">
            <div class="card-header">
                <div class="flex items-center {{ $errors->has("$list_name.$in.name") ? 'invalid' : '' }}">
                    <label class="text-gray-600 pr-2"
                        for="{{ $list_name }}_{{ $in }}_name">{{ $name }}
                        N°{{ $in + 1 }}</label>
                </div>
                <div class="form-group {{ $errors->has("$list_name.$in.category_id") ? 'invalid' : '' }}">
                    <label class="form-label required"
                        for="{{ $list_name }}_{{ $in }}_category_id">{{ trans('cruds.attachment.fields.category') }}</label>
                    <x-select-list class="form-control" required
                        id="{{ $list_name }}_{{ $in }}_category_id"
                        name="{{ $list_name }}[{{ $in }}]['category']" :options="$this->listsForFields['category']"
                        wire:model="{{ $list_name }}.{{ $in }}.category_id" />
                    <div class="validation-message">
                        {{ $errors->first("$list_name.$in.category_id") }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.attachment.fields.category_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has("$list_name.$in.description") ? 'invalid' : '' }}">
                    <label class="form-label"
                        for="{{ $list_name }}_{{ $in }}_description">{{ trans('cruds.attachment.fields.description') }}</label>
                    <textarea class="form-control" name="{{ $list_name }}[{{ $in }}]['description']"
                        id="{{ $list_name }}_{{ $in }}_description"
                        wire:model.defer="{{ $list_name }}.{{ $in }}.description" rows="4"></textarea>
                    <div class="validation-message">
                        {{ $errors->first("$list_name.$in.description") }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.attachment.fields.description_helper') }}
                    </div>
                </div>
                <div
                    class="form-group {{ $errors->has("$list_name.$in.mediaCollections.attachment_src") ? 'invalid' : '' }}">
                    <label class="form-label" for="src">{{ trans('cruds.attachment.fields.src') }}</label>
                    <x-dropzone-v2 id="{{ $list_name }}_{{ $in }}_src"
                        name="{{ $list_name }}[{{ $in }}]['src']"
                        action="{{ route('admin.attachments.storeMedia') }}" collection-name="attachment_src"
                        max-file-size="2" max-files="1" in="{{ $in }}" />
                    <div class="validation-message">
                        {{ $errors->first("$list_name.$in.mediaCollections.attachment_src") }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.attachment.fields.src_helper') }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-4">
        <button class="px-4 py-2 text-sm font-medium btn btn-indigo" wire:click.prevent="addtest_array()">+ Agregar
            arrat</button>
    </div> --}}
</form>
