<div class="flex items-center gap-x-1">
    <span class='badge badge-pill alert-table badge-warning text-black'>{{$status}}</span>
    @if($model->status != 4 || auth()->user()->hasRole('super-admin'))
        <x-button.circle wire:click="editStatus({{$model}})" icon="pencil"></x-button.circle>
    @endif
</div>
