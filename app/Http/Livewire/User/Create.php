<?php

namespace App\Http\Livewire\User;

use App\Models\Dependency;
use App\Models\Direction;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public User $user;

    public array $roles = [];

    public string $password = '';

    public array $listsForFields = [];

    public $selectedDirection;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.user.create');
    }

    public function submit()
    {
        $this->validate();
        $this->user->password = $this->password;
        $this->user->save();
        $this->user->roles()->sync($this->roles);

        return redirect()->route('admin.users.index');
    }

    protected function rules(): array
    {
        return [
            'user.name' => [
                'string',
                'required',
            ],
            'user.email' => [
                'email:rfc',
                'required',
                'unique:users,email',
            ],
            'password' => [
                'string',
                'required',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'roles.*.id' => [
                'integer',
                'exists:roles,id',
            ],
            'user.locale' => [
                'string',
                'nullable',
            ],
            'user.dependency_id' => [
                'integer',
                'nullable',
            ],
        ];
    }

    public function updatedSelectedDirection($direction)
    {
        $this->listsForFields['dependency'] = Dependency::where('direction_id' , '=' , $direction)->pluck('name' , 'id')->toArray();
        $this->selectedDirection = $direction;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['roles'] = Role::pluck('title', 'id')->toArray();
        $this->listsForFields['dependencies'] = null;
        $this->listsForFields['direction'] = Direction::pluck('name' , 'id')->toArray();
    }
}
