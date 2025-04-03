<div>

    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit">
            Submit Review
        </button>
    </form>

    <x-filament-actions::modals />

    <div
        x-data="{ show: false, message: '' }"
        x-show="show"
        x-transition
        x-on:notify.window="
            show = true;
            message = $event.detail.message;
            setTimeout(() => show = false, 3000);
        "
        class="fixed bottom-4 right-4 p-4 rounded-lg shadow-lg bg-green-500 text-white"
    >
        <p x-text="message"></p>
    </div>

</div>
