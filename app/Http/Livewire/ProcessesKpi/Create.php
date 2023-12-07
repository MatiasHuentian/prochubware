<?php

namespace App\Http\Livewire\ProcessesKpi;

use App\Models\Process;
use App\Models\ProcessesKpi;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    public ProcessesKpi $processesKpi;

    public function mount(ProcessesKpi $processesKpi)
    {
        $this->processesKpi = $processesKpi;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.processes-kpi.create');
    }

    public function submit()
    {
        $this->validate();

        $this->processesKpi->save();

        return redirect()->route('admin.processes-kpis.index');
    }

    protected function rules(): array
    {
        return [
            'processesKpi.process_id' => [
                'integer',
                'exists:processes,id',
                'required',
            ],
            'processesKpi.name' => [
                'string',
                'max:100',
                'required',
            ],
            'processesKpi.description' => [
                'string',
                'nullable',
            ],
            'processesKpi.calculate_form' => [
                'string',
                'nullable',
            ],
            'processesKpi.ubication_data' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['process'] = Process::pluck('name', 'id')->toArray();
    }
}
