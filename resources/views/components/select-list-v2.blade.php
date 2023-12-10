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
</div>

{{-- @push('scripts') --}}
    <script>
        window.addEventListener('apply_select2', event => {
            let el = $('#{{ $attributes['id'] }}')
            let buttonsId = '#{{ $attributes['id'] }}-btn-container'
            function initSelect() {
                // console.log("v2 fall");
                el.select2({
                    placeholder: '{{ __('Seleccione una opción') }}',
                    allowClear: !el.attr('required')
                })
            }
            initSelect()
            el.on('change', function(e) {
                let data = $(this).select2("val")
                if (data === "") {
                    data = null
                }
                @this.set('{{ $attributes['wire:model'] }}', data)
            });
        });
    </script>
{{-- @endpush --}}
