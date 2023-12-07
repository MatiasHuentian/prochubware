<?php

namespace App\Http\Livewire\RisksControlsType;

use App\Models\RisksControlsType;
use Livewire\Component;

class Create extends Component
{
    public RisksControlsType $risksControlsType;

    public function mount(RisksControlsType $risksControlsType)
    {
        $this->risksControlsType = $risksControlsType;
    }

    public function render()
    {
        return view('livewire.risks-controls-type.create');
    }

    public function submit()
    {
        $this->validate();

        $this->risksControlsType->save();

        return redirect()->route('admin.risks-controls-types.index');
    }

    protected function rules(): array
    {
        return [
            'risksControlsType.name' => [
                'string',
                'max:100',
                'required',
                'unique:risks_controls_types,name',
            ],
        ];
    }
}
