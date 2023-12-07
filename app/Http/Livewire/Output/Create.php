<?php

namespace App\Http\Livewire\Output;

use App\Models\Output;
use Livewire\Component;

class Create extends Component
{
    public Output $output;

    public function mount(Output $output)
    {
        $this->output = $output;
    }

    public function render()
    {
        return view('livewire.output.create');
    }

    public function submit()
    {
        $this->validate();

        $this->output->save();

        return redirect()->route('admin.outputs.index');
    }

    protected function rules(): array
    {
        return [
            'output.name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
