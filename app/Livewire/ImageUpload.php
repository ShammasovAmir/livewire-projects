<?php

namespace App\Livewire;


use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public TemporaryUploadedFile|ImageUpload|array $image = [];

    public function save(): void
    {
        $this->validate([
            'image.*' => 'image|max:1024'
        ]);

        foreach ($this->image as $image) {
            $image->store('public');
        }
    }

    public function render(): View|Application|Factory|ContractApplication
    {
        return view('livewire.image-upload', [
            'images' => collect(Storage::files('public'))
                ->filter(fn($file) => in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), [
                    'png',
                    'jpg',
                    'jpeg',
                    'gif',
                    'webp'
                ]))
                ->map(fn($file) => Storage::url($file))
        ]);
    }
}
