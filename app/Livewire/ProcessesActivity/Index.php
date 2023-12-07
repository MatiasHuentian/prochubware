<?php

namespace App\Http\Livewire\ProcessesActivity;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\ProcessesActivity;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithSorting, WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new ProcessesActivity())->orderable;
    }

    public function render()
    {
        $query = ProcessesActivity::with(['process'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $processesActivities = $query->paginate($this->perPage);

        return view('livewire.processes-activity.index', compact('processesActivities', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('processes_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ProcessesActivity::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(ProcessesActivity $processesActivity)
    {
        abort_if(Gate::denies('processes_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processesActivity->delete();
    }
}
