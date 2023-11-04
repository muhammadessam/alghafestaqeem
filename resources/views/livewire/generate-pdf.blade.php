<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="font-bold text-xl">{{trans('admin.price_offer')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <x-select
                                    class="mb-3"
                                    wire:model.live="title"
                                    :options="['السيد','السادة']"
                                    label="اللقب"
                                />
                                <x-input class="mb-3" label="الرقم التسلسلي" wire:model.live="serial"/>
                                <x-input class="mb-3" label="المدينة" wire:model.live="city"/>
                                <x-input class="mb-3" label="الغرض من التقييم" wire:model.live="purpose"/>
                            </div>
                            <div class="col">
                                <x-input class="mb-3" label="اسم العميل" wire:model.live="client_name"/>
                                <x-input class="mb-3" label="النوع" wire:model.live="general_type"/>
                                <x-input class="mb-3" label="الحي" wire:model.live="area"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header flex justify-between">
                        <h3 class="font-bold text-xl">التفاصيل</h3>
                        <x-button.circle icon="plus-circle" wire:click="addMore"/>
                    </div>
                    <div class="card-body">
                        @foreach($groups as $index=>$group)
                            <div class="row mb-3" wire:key="{{$index}}">
                                <div class="col">
                                    <x-select
                                        wire:model.live="groups.{{$index}}.type"
                                        :options="\App\Models\Category::where('type',1)->get()"
                                        label="نوع العقار"
                                        option-value="title"
                                        option-label="title"
                                    />
                                </div>
                                <div class="col">
                                    <x-input  wire:model.live="groups.{{$index}}.number" label="رقم الصك"/>
                                </div>
                                <div class="col">
                                    <div class="flex items-end">
                                        <x-input type="number" step="0.1" wire:model.live="groups.{{$index}}.price" label="الاتعاب">
                                            <x-slot name="prepend">
                                                <div class="absolute inset-y-0 left-0 flex items-center p-0.5">
                                                    <x-button primary flat squared icon="minus-circle" wire:click="removeGroup('{{$index}}')"/>
                                                </div>
                                            </x-slot>
                                        </x-input>
                                    </div>
                                </div>
                                @if(isset($groups[$index]['price']) and is_numeric($groups[$index]['price']))
                                    <div class="col">
                                        <span class="d-block font-bold">الضريبة 15% :</span>
                                        <span class="d-block mt-3 font-bold">{{$groups[$index]['price'] * 0.15}}</span>
                                    </div>
                                    <div class="col">
                                        <span class="d-block font-bold">المجموع: </span>
                                        <span class="d-block mt-3 font-bold">{{($groups[$index]['price'] * 0.15) + $groups[$index]['price']}}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col font-bold">الاجمالي: </div>
                            <div class="col">{{collect($groups)->sum('total')}}</div>
                        </div>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col font-bold">مجموع الارقام كتابة</div>
                                <div class="col">
                                    <x-input wire:model.live="price_in_words"></x-input>
                                </div>
                            </div>
                        <div class="row mt-5">
                            <div class="col">
                                <x-button label="انشاء الملف" wire:click="generate"></x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
