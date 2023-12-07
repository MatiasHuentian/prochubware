<?php

namespace App\Http\Livewire\ObejctivesGroup;

use App\Models\ObejctivesGroup;
use Livewire\Component;

class Create extends Component
{
    public ObejctivesGroup $obejctivesGroup;

    public function mount(ObejctivesGroup $obejctivesGroup)
    {
        $this->obejctivesGroup = $obejctivesGroup;
    }

    public function render()
    {
        return view('livewire.obejctives-group.create');
    }

    public function submit()
    {
        $this->validate();

        $this->obejctivesGroup->save();

        return redirect()->route('admin.obejctives-groups.index');
    }

    protected function rules(): array
    {
        return [
            'obejctivesGroup.name' => [
                'string',
                'max:200',
                'required',
            ],
        ];
    }
}
