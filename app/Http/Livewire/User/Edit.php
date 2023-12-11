<?php

namespace App\Http\Livewire\User;

use App\Models\Dependency;
use App\Models\Direction;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public User $user;

    public array $roles = [];

    public string $password = '';

    public array $listsForFields = [];

    public $selectedDirection;

    public function mount(User $user)
    {
        $this->user  = $user;
        $this->roles = $this->user->roles()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        $this->selectedDirection = $this->user->dependency->direction_id ?? null;
        $this->updatedSelectedDirection( $this->selectedDirection);
        return view('livewire.user.edit');
    }

    public function submit()
    {
        $this->validate();
        if( $this->password != "" ){
            $this->user->password = $this->password;
        }
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
                'unique:users,email,' . $this->user->id,
            ],
            'password' => [
                'nullable',
                'string',
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
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['dependencies'] = null;
        $this->listsForFields['direction'] = Direction::pluck('name' , 'id')->toArray();
        $this->listsForFields['roles'] = Role::pluck('title', 'id')->toArray();
    }
}
