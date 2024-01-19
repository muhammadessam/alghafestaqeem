<?php

namespace App\Livewire\Contracts;

use App\Models\Contract;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateContract extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('token')
                    ->default(random_int(100000, 999999))
                    ->required(),
                Forms\Components\TextInput::make('client_name')
                    ->label(__('forms/contracts.client_name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('id_number')
                    ->label(__('forms/contracts.id_number'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('client_address')
                    ->label(__('forms/contracts.client_address'))
                    ->required(),
                Forms\Components\TextInput::make('phone_numbers')
                    ->label(__('forms/contracts.phone_numbers'))
                    ->helperText(__('forms/contracts.phone_numbers_helper_text'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('forms/contracts.email'))
                    ->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('representative_name')
                    ->label(__('forms/contracts.representative_name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('purpose')
                    ->label(__('forms/contracts.purpose'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label(__('forms/contracts.type'))
                    ->options(function () {
                        $categories = \App\Models\Category::where('type', 1)->get()->toArray();
                        $options = [];
                        foreach ($categories as $category) {
                            $options[$category['slug']] = __('categories.' . $category['slug']);
                        }
                        return $options;
                    })
                    ->required(),
                Forms\Components\TextInput::make('area')
                    ->label(__('forms/contracts.area'))
                    ->suffix(__('forms/contracts.area_suffix'))
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('property_address')
                    ->label(__('forms/contracts.property_address'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('deed_number')
                    ->label(__('forms/contracts.deed_number'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('deed_issue_date')
                    ->label(__('forms/contracts.deed_issue_date'))
                    ->required(),
                Forms\Components\TextInput::make('number_of_assets')
                    ->label(__('forms/contracts.number_of_assets'))
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $og_total = (integer) $get('number_of_assets') * (integer) $get('cost_per_asset');
                        $set('total_cost', round($og_total * 1.15)); // Apply 15% tax
                        $set('tax', $og_total * 0.15);
                    })
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cost_per_asset')
                    ->label(__('forms/contracts.cost_per_asset'))
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $og_total = (integer) $get('number_of_assets') * (integer) $get('cost_per_asset');
                        $set('total_cost', round($og_total * 1.15)); // Apply 15% tax
                        $set('tax', $og_total * 0.15);
                    })
                    ->required()
                    ->maxLength(255),
                Forms\Components\Hidden::make('tax')
                    ->required(),
                Forms\Components\TextInput::make('total_cost')
                    ->label(__('forms/contracts.total_cost'))
                    ->required()
                    ->helperText(fn(callable $get) => 'شامل الضريبة 15% (' . $get('tax') . ')')
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $og_total = (integer) $get('number_of_assets') * (integer) $get('cost_per_asset');
                        $set('tax', $og_total * 0.15);
                    }),
                Forms\Components\TextInput::make('total_cost_in_words')
                    ->label(__('forms/contracts.total_cost_in_words'))
            ])
            ->statePath('data')
            ->model(Contract::class)
            ->columns(2);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Contract::create($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->to('admin/contracts');
    }

    public function render(): View
    {
        return view('livewire.contracts.create-contract');
    }
}