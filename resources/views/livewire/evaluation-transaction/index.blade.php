<div>

    <livewire:transaction-table :is_daily="$is_daily" :company="$company"></livewire:transaction-table>

    <x-filament::modal id="edit-status" alignment="center" :heading="__('admin.ChangeStatus')">
        <label for="">{{trans('admin.Status')}}</label>
        <x-filament::input.wrapper>
            <x-filament::input.select wire:model.live="status">
                <option value="0">{{trans('admin.NewTransaction')}}</option>
                <option value="1">{{trans('admin.InReviewRequest')}}</option>
                <option value="2">{{trans('admin.ContactedRequest')}}</option>
                <option value="3">{{trans('admin.ReviewedRequest')}}</option>
                <option value="4">{{trans('admin.FinishedRequest')}}</option>
                <option value="5">{{trans('admin.PendingRequest')}}</option>
                <option value="6">{{trans('admin.Cancelled')}}</option>
            </x-filament::input.select>
        </x-filament::input.wrapper>
        <x-slot:footerActions>
            <x-button class="btn btn-primary" wire:click="updateStatus">{{__('admin.Save')}}</x-button>
            <x-button class="btn btn-secondary" x-on:click="close">{{__('admin.Cancel')}}</x-button>
        </x-slot:footerActions>
    </x-filament::modal>

    <x-filament::modal id="edit-details" alignment="center" :heading="__('admin.TransactionDetail')">
        {{ $this->form }}

        <x-slot:footerActions>
            <x-button class="btn btn-primary" wire:click="save">{{__('admin.Save')}}</x-button>
            <x-button class="btn btn-secondary" x-on:click="close">{{__('admin.Cancel')}}</x-button>
        </x-slot:footerActions>
    </x-filament::modal>

</div>
