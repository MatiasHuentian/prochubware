<?php

namespace App\Http\Livewire\ActivitiesRisksPolitic;

use App\Models\ActivitiesRisksPolitic;
use Livewire\Component;

class Edit extends Component
{
    public ActivitiesRisksPolitic $activitiesRisksPolitic;

    public function mount(ActivitiesRisksPolitic $activitiesRisksPolitic)
    {
        $this->activitiesRisksPolitic = $activitiesRisksPolitic;
    }

    public function render()
    {
        return view('livewire.activities-risks-politic.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->activitiesRisksPolitic->save();

        return redirect()->route('admin.activities-risks-politics.index');
    }

    protected function rules(): array
    {
        return [
            'activitiesRisksPolitic.name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
