<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    // customize redirect after edit
    public function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('edit', [
            'record' => $this->record,
        ]);
    }

    // mutate form data before fill
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['rating'] = $this->record->postRatings()
            ->where('user_id', Auth::id())
            ->first()
            ->rating ?? null;

        return $data;
    }

    public function afterSave(): void
    {
        if (isset($this->data['rating'])) {
            $this->record->postRatings()->updateOrCreate(
                ['user_id' => Auth::id()],
                ['rating' => $this->data['rating']]
            );
        }
    }
}
