<div>

    <livewire:transaction-table :company="$company"></livewire:transaction-table>

    <x-modal.card squared align="center" wire:model.live="status_modal" :title="__('admin.ChangeStatus')">
        <x-select
            label="{{trans('admin.Status')}}"
            placeholder="{{trans('admin.Status')}}"
            :options="[
                    ['id' => 0, 'name' => trans('admin.NewTransaction')],
                    ['id' => 1, 'name' => trans('admin.InReviewRequest')],
                    ['id' => 2, 'name' => trans('admin.ContactedRequest')],
                    ['id' => 3, 'name' => trans('admin.ReviewedRequest')],
                    ['id' => 4, 'name' => trans('admin.FinishedRequest')],
                    ['id' => 5, 'name' => trans('admin.PendingRequest')],
                    ['id' => 6, 'name' => trans('admin.Cancelled')],
                ]"
            option-label="name"
            option-value="id"
            wire:model.live="status"
        />
        <x-slot:footer>
            <x-button class="btn btn-primary" wire:click="updateStatus">{{__('admin.Save')}}</x-button>
            <x-button class="btn btn-secondary" x-on:click="close">{{__('admin.Cancel')}}</x-button>
        </x-slot:footer>
    </x-modal.card>

    <x-modal.card squared align="center" wire:model.live="details_modal" :title="__('admin.TransactionDetail')">
        <x-select
            class="mb-3"
            searchable
            label="{{trans('admin.city')}}"
            wire:model.live="city_id"
            :options="\App\Models\Category::where('type',4)->get()"
            option-label="title"
            option-value="id"/>

        <x-select
            class="mb-3"
            searchable
            label="{{trans('admin.EvaluationCompanies')}}"
            wire:model.live="evaluation_company_id"
            :options="\App\Models\Evaluation\EvaluationCompany::all()"
            option-label="title"
            option-value="id"/>
        <x-select
            class="mb-3"
            searchable
            label="{{trans('admin.review')}}"
            wire:model.live="review_id"
            :options="\App\Models\Evaluation\EvaluationEmployee::all()"
            option-label="title"
            option-value="id"/>

        <x-select
            class="mb-3"
            searchable
            label="{{trans('admin.income')}}"
            wire:model.live="income_id"
            :options="\App\Models\Evaluation\EvaluationEmployee::all()"
            option-label="title"
            option-value="id"/>

        <x-select
            class="mb-3"
            searchable
            label="{{trans('admin.previewer')}}"
            wire:model.live="previewer_id"
            :options="\App\Models\Evaluation\EvaluationEmployee::all()"
            option-label="title"
            option-value="id"/>

        <x-textarea wire:model.live="notes"/>

        <x-slot:footer>
            <x-button class="btn btn-primary" wire:click="save">{{__('admin.Save')}}</x-button>
            <x-button class="btn btn-secondary" x-on:click="close">{{__('admin.Cancel')}}</x-button>
        </x-slot:footer>
    </x-modal.card>


</div>
