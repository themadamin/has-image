<?php

namespace Themadamin\HasImage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasThumbnail
{
    protected UploadedFile $file;
    protected string $collection;

    public function uploadFile(UploadedFile $file): static
    {
        $this->file = $file;
        return $this;
    }

    public function toMediaCollection($collection): false|string
    {
        $this->collection = $collection;

        $filePath = $this->generateFilePath();

        $this->saveFilePathToModel($filePath);

        return $filePath;
    }

    protected function generateFilePath(): string
    {
        $path = $this->getMediaCollectionPath();

        $filename = uniqid().'.'.$this->file->getClientOriginalName();

        return $this->file->storeAs($path, $filename, 'public');
    }

    protected function getMediaCollectionPath(): string
    {
        return $this->collection.'/'.$this->id;
    }

    protected function saveFilePathToModel($filePath, $attribute = 'thumbnail'): void
    {
        $this->{$attribute} = $filePath;
        $this->save();
    }

    public function getFileUrl($attribute = 'thumbnail')
    {
        $filePath = $this->getAttribute($attribute);

        if ($filePath) {
            return asset($filePath);
        }

        return null;
    }

    public function clearMediaCollection($attribute = 'thumbnail'): void
    {
        Storage::disk('public')->delete($this->getAttribute($attribute));
    }

}
