<?php

namespace App\Http\Livewire\ActivitiesRisksImpact;

use App\Models\ActivitiesRisksImpact;
use Livewire\Component;

class Edit extends Component
{
    public ActivitiesRisksImpact $activitiesRisksImpact;

    public function mount(ActivitiesRisksImpact $activitiesRisksImpact)
    {
        $this->activitiesRisksImpact = $activitiesRisksImpact;
    }

    public function render()
    {
        return view('livewire.activities-risks-impact.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->activitiesRisksImpact->save();

        return redirect()->route('admin.activities-risks-impacts.index');
    }

    protected function rules(): array
    {
        return [
            'activitiesRisksImpact.name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
