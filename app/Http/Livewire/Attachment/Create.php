<?php

namespace App\Http\Livewire\Attachment;

use App\Models\Attachment;
use App\Models\AttachmentsCategory;
use App\Models\Process;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Attachment $attachment;

    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->attachment->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Attachment $attachment)
    {
        $this->attachment = $attachment;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.attachment.create');
    }

    public function submit()
    {
        $this->validate();

        $this->attachment->save();
        $this->syncMedia();

        return redirect()->route('admin.attachments.index');
    }

    protected function rules(): array
    {
        return [
            'attachment.process_id' => [
                'integer',
                'exists:processes,id',
                'required',
            ],
            'attachment.category_id' => [
                'integer',
                'exists:attachments_categories,id',
                'required',
            ],
            'mediaCollections.attachment_src' => [
                'array',
                'nullable',
            ],
            'mediaCollections.attachment_src.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'mediaCollections.attachment_src.*.mime_type' => [
                'string',
                Rule::in([
                    'text/plain',
                    'text/html',
                    'text/css',
                    // ... otras opciones ...
                    'application/pdf',
                    'application/zip',
                    'application/json',
                    'application/xml',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    // ... otras opciones ...
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    // ... otras opciones ...
                    'audio/mpeg',
                    'audio/wav',
                    'audio/ogg',
                    // ... otras opciones ...
                    'video/mp4',
                    'video/webm',
                    'video/ogg',
                    // ... otras opciones ...
                ]),
            ],
            'attachment.description' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['process']  = Process::pluck('name', 'id')->toArray();
        $this->listsForFields['category'] = AttachmentsCategory::pluck('name', 'id')->toArray();
    }
}
