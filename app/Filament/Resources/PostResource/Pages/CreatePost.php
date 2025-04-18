<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected static bool $canCreateAnother = false;

    // customize redirect after create
    public function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('edit', [
            'record' => $this->record,
        ]);
    }

    // mutate form data before save
    public function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['rating'])) {
            unset($data['rating']);
        }

        return $data;
    }

    // mutate form data after save
    protected function afterCreate(): void
    {
        if (isset($this->data['rating'])) {
            $this->record->postRatings()->updateOrCreate(
                ['user_id' => Auth::id()],
                ['rating' => $this->data['rating']]
            );
        }
    }
}
