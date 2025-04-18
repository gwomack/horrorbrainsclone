<div>

    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit">
            Submit Review
        </button>
    </form>

    <x-filament-actions::modals />

</div>
