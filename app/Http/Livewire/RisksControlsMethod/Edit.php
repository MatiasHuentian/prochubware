<?php

namespace App\Http\Livewire\RisksControlsMethod;

use App\Models\RisksControlsMethod;
use Livewire\Component;

class Edit extends Component
{
    public RisksControlsMethod $risksControlsMethod;

    public function mount(RisksControlsMethod $risksControlsMethod)
    {
        $this->risksControlsMethod = $risksControlsMethod;
    }

    public function render()
    {
        return view('livewire.risks-controls-method.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->risksControlsMethod->save();

        return redirect()->route('admin.risks-controls-methods.index');
    }

    protected function rules(): array
    {
        return [
            'risksControlsMethod.name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
