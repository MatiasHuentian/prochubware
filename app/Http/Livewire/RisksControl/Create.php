<?php

namespace App\Http\Livewire\RisksControl;

use App\Models\ActivitiesRisk;
use App\Models\RisksControl;
use App\Models\RisksControlsFrecuency;
use App\Models\RisksControlsMethod;
use App\Models\RisksControlsType;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    public RisksControl $risksControl;

    public function mount(RisksControl $risksControl)
    {
        $this->risksControl = $risksControl;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.risks-control.create');
    }

    public function submit()
    {
        $this->validate();

        $this->risksControl->save();

        return redirect()->route('admin.risks-controls.index');
    }

    protected function rules(): array
    {
        return [
            'risksControl.risk_id' => [
                'integer',
                'exists:activities_risks,id',
                'required',
            ],
            'risksControl.name' => [
                'string',
                'max:100',
                'required',
            ],
            'risksControl.frecuency_id' => [
                'integer',
                'exists:risks_controls_frecuencies,id',
                'nullable',
            ],
            'risksControl.method_id' => [
                'integer',
                'exists:risks_controls_methods,id',
                'nullable',
            ],
            'risksControl.type_id' => [
                'integer',
                'exists:risks_controls_types,id',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['risk']      = ActivitiesRisk::pluck('name', 'id')->toArray();
        $this->listsForFields['frecuency'] = RisksControlsFrecuency::pluck('name', 'id')->toArray();
        $this->listsForFields['method']    = RisksControlsMethod::pluck('name', 'id')->toArray();
        $this->listsForFields['type']      = RisksControlsType::pluck('name', 'id')->toArray();
    }
}
