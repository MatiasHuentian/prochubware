<?php

namespace App\Http\Livewire\Direction;

use App\Models\Direction;
use Livewire\Component;

class Create extends Component
{
    public Direction $direction;

    public function mount(Direction $direction)
    {
        $this->direction = $direction;
    }

    public function render()
    {
        return view('livewire.direction.create');
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
