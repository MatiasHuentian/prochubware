<div>
    <div wire:ignore class="w-full">
        <select class="select2 form-control" data-placeholder="{{ __('Seleccione una opción') }}" {{ $attributes }} >
            @if (!isset($attributes['multiple']))
                <option></option>
            @endif
            @foreach ($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("livewire:load", () => {
            let el = $('#{{ $attributes['id'] }}')
            let buttonsId = '#{{ $attributes['id'] }}-btn-container'
            function initSelect() {
                // initButtons()
                // console.log("select with pivot");
                el.select2({
                    placeholder: '{{ __('Seleccione una opción') }}',
                    allowClear: !el.attr('required'),
                    tags: true,
                    multiple:true
                })
            }

            initSelect()

            Livewire.hook('message.processed', (message, component) => {
                initSelect()
            });

            el.on('change', function(e) {
                let data = $(this).select2("val")
                if (data === "") {
                    data = null
                }
                @this.set('{{ $attributes['wire:model'] }}', data)
                callLivewireFunction_{{ $attributes['id'] }}();
            });
        });
        // let change_function = "{{ $changefunction }}";
        const change_function_{{ $attributes['id'] }} = "{{ $changefunction }}";

        function callLivewireFunction_{{ $attributes['id'] }}() {
            @this.call(change_function_{{ $attributes['id'] }}); // Llama a la función de Livewire
        }
    </script>
@endpush
