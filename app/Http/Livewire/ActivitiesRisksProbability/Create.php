<?php

namespace App\Http\Livewire\ActivitiesRisksProbability;

use App\Models\ActivitiesRisksProbability;
use Livewire\Component;

class Create extends Component
{
    public ActivitiesRisksProbability $activitiesRisksProbability;

    public function mount(ActivitiesRisksProbability $activitiesRisksProbability)
    {
        $this->activitiesRisksProbability = $activitiesRisksProbability;
    }

    public function render()
    {
        return view('livewire.activities-risks-probability.create');
    }

    public function submit()
    {
        $this->validate();

        $this->activitiesRisksProbability->save();

        return redirect()->route('admin.activities-risks-probabilities.index');
    }

    protected function rules(): array
    {
        return [
            'activitiesRisksProbability.name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
