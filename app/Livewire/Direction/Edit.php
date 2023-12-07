<?php

namespace App\Http\Livewire\Direction;

use App\Models\Direction;
use Livewire\Component;

class Edit extends Component
{
    public Direction $direction;

    public function mount(Direction $direction)
    {
        $this->direction = $direction;
    }

    public function render()
    {
        return view('livewire.direction.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->direction->save();

        return redirect()->route('admin.directions.index');
    }

    protected function rules(): array
    {
        return [
            'direction.name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
