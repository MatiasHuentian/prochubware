<div>
    <div wire:ignore class="w-full">
        <select class="select2 form-control" data-placeholder="{{ __('Descripciones utilizadas') }}" {{ $attributes }}>
            @if (!isset($attributes['multiple']))
                <option></option>
            @endif
            @foreach ($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    @if ($attributes['modoEdicion'])
        <script>
            document.addEventListener('livewire:load', function() {
                function initSelect() {
                    let el = $('#{{ $attributes['id'] }}');
                    // console.log("v3 fall");
                    el.select2({
                        placeholder: '{{ __('Select your option') }}',
                        allowClear: !el.attr('required')
                    });

                    el.on('change', function(e) {
                        let data = $(this).select2("val");
                        if (data === "") {
                            data = null;
                        }
                        @this.set('{{ $attributes['wire:model'] }}', data);
                    });
                }

                // Inicializar después de que Livewire ha cargado o actualizado
                initSelect();
            });
        </script>
    @else
        <script>
            document.addEventListener('livewire:load', function() {
                function initSelect() {
                    let el = $('#{{ $attributes['id'] }}');
                    // console.log("velse fall");
                    el.select2({
                        placeholder: '{{ __('Select your option') }}',
                        allowClear: !el.attr('required')
                    });
                    el.on('change', function(e) {
                        let data = $(this).select2("val");
                        if (data === "") {
                            data = null;
                        }
                        @this.set('{{ $attributes['wire:model'] }}', data);
                    });
                }

                // Inicializar directamente, sin la variable Livewire
                initSelect();
            });
        </script>
    @endif


</div>
