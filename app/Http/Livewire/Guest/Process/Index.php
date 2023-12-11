<?php

namespace App\Http\Livewire\Guest\Process;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Dependency;
use App\Models\Direction;
use App\Models\Process;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithSorting, WithConfirmation;

    public $user_id = null;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

    public $selectedDirection;
    public $selectedDependency;


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

    public function mount($user_id = null)
    {
        $this->user_id = $user_id;
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Process())->orderable;

        $this->initListsForFields();
        // foreach($this->listsForFields['direction'] as $i =>  $value){
        //     dd($value);
        // }
        // dd( $this->listsForFields['direction'] );
    }

    public function render()
    {
        $query = Process::with(['owner', 'dependency.direction', 'state', 'glosary', 'input', 'output', 'objectiveGroup'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ])->OnlyActives(true)
            ->DireccionDependency($this->selectedDirection, $this->selectedDependency)
            ->OnlyOwner($this->user_id ?? null);

        $processes = $query->paginate($this->perPage);

        return view('livewire.guest.process.index', compact('processes', 'query'));
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['direction']           = Direction::pluck('name', 'id')->toArray();
        $this->listsForFields['dependency']           = "";
    }

    public function updatedSelectedDirection($direction)
    {
        $this->listsForFields['dependency'] = Dependency::where('direction_id', '=', $direction)->pluck('name', 'id')->toArray();
        $this->resetPage();
        // $this->selectedDe = $direction;
    }

    // public function deleteSelected()
    // {
    //     abort_if(Gate::denies('process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     Process::whereIn('id', $this->selected)->delete();

    //     $this->resetSelected();
    // }

    // public function delete(Process $process)
    // {
    //     abort_if(Gate::denies('process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $process->delete();
    // }
}
