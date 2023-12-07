<?php

namespace App\Http\Livewire\ActivitiesRisksCause;

use App\Models\ActivitiesRisk;
use App\Models\ActivitiesRisksCause;
use Livewire\Component;

class Edit extends Component
{
    public array $listsForFields = [];

    public ActivitiesRisksCause $activitiesRisksCause;

    public function mount(ActivitiesRisksCause $activitiesRisksCause)
    {
        $this->activitiesRisksCause = $activitiesRisksCause;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.activities-risks-cause.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->activitiesRisksCause->save();

        return redirect()->route('admin.activities-risks-causes.index');
    }

    protected function rules(): array
    {
        return [
            'activitiesRisksCause.risk_id' => [
                'integer',
                'exists:activities_risks,id',
                'required',
            ],
            'activitiesRisksCause.name' => [
                'string',
                'max:100',
                'required',
            ],
            'activitiesRisksCause.description' => [
                'string',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['risk'] = ActivitiesRisk::pluck('name', 'id')->toArray();
    }
}
