<div>
    <form wire:submit="create">
        {{ $this->form }}

        <x-button label="{{ __('forms/contracts.submit') }}" type="submit"></x-button>
    </form>

    <x-filament-actions::modals />
</div>