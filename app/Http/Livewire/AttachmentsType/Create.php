<?php

namespace App\Http\Livewire\AttachmentsType;

use App\Models\AttachmentsType;
use Livewire\Component;

class Create extends Component
{
    public AttachmentsType $attachmentsType;

    public function mount(AttachmentsType $attachmentsType)
    {
        $this->attachmentsType         = $attachmentsType;
        $this->attachmentsType->active = false;
    }

    public function render()
    {
        return view('livewire.attachments-type.create');
    }

    public function submit()
    {
        $this->validate();

        $this->attachmentsType->save();

        return redirect()->route('admin.attachments-types.index');
    }

    protected function rules(): array
    {
        return [
            'attachmentsType.name' => [
                'string',
                'max:100',
                'required',
            ],
            'attachmentsType.active' => [
                'boolean',
            ],
        ];
    }
}
