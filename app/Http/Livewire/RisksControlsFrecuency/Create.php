<?php

namespace App\Http\Livewire\RisksControlsFrecuency;

use App\Models\RisksControlsFrecuency;
use Livewire\Component;

class Create extends Component
{
    public RisksControlsFrecuency $risksControlsFrecuency;

    public function mount(RisksControlsFrecuency $risksControlsFrecuency)
    {
        $this->risksControlsFrecuency = $risksControlsFrecuency;
    }

    public function render()
    {
        return view('livewire.risks-controls-frecuency.create');
    }

    public function submit()
    {
        $this->validate();

        $this->risksControlsFrecuency->save();

        return redirect()->route('admin.risks-controls-frecuencies.index');
    }

    protected function rules(): array
    {
        return [
            'risksControlsFrecuency.name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
