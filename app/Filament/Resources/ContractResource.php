<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractResource\Pages;
use App\Filament\Resources\ContractResource\RelationManagers;
use App\Models\Contract;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractResource extends Resource
{
    protected static ?string $model = Contract::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getModelLabel(): string
    {
        return __('resources.Contract.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.Contract.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources.Contract.plural');
    }

    public static function form(Form $form): Form
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
                        $og_total = (int) $get('number_of_assets') * (int) $get('cost_per_asset');
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
                        $og_total = (int) $get('number_of_assets') * (int) $get('cost_per_asset');
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
                    ->helperText(fn (callable $get) => 'شامل الضريبة 15% (' . $get('tax') . ')')
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $og_total = (int) $get('number_of_assets') * (int) $get('cost_per_asset');
                        $set('tax', $og_total * 0.15);
                    }),
                Forms\Components\TextInput::make('total_cost_in_words')
                    ->label(__('forms/contracts.total_cost_in_words'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('has_been_signed')
                    ->label(__('tables/contracts.has_been_signed'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('token')
                    ->label(__('tables/contracts.token'))
                    ->numeric()
                    ->formatStateUsing(fn ($state) => $state)
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage(__('tables/contracts.copy_token'))
                    ->copyMessageDuration(1500)
                    ->copyableState(fn ($state) => config('app.url') . '/sign/' . $state)
                    ->description('اضغط لنسخ رابط التوقيع'),
                Tables\Columns\TextColumn::make('client_name')
                    ->label(__('tables/contracts.client_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_number')
                    ->label(__('tables/contracts.id_number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('tables/contracts.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('representative_name')
                    ->label(__('tables/contracts.representative_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->label(__('tables/contracts.purpose'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('tables/contracts.type'))
                    ->formatStateUsing(fn ($state) => __('categories.' . $state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('area')
                    ->label(__('tables/contracts.area'))
                    ->numeric()
                    ->formatStateUsing(fn ($state) => $state)
                    ->description(__('tables/contracts.area_suffix'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('deed_number')
                    ->label(__('tables/contracts.deed_number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('deed_issue_date')
                    ->label(__('tables/contracts.deed_issue_date'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_assets')
                    ->label(__('tables/contracts.number_of_assets'))
                    ->numeric()
                    ->formatStateUsing(fn ($state) => $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost_per_asset')
                    ->label(__('tables/contracts.cost_per_asset'))
                    ->money('SAR')
                    ->description(__('tables/contracts.currency'))
                    ->formatStateUsing(fn ($state) => $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cost')
                    ->label(__('tables/contracts.total_cost'))
                    ->money('SAR')
                    ->description(__('tables/contracts.currency'))
                    ->formatStateUsing(fn ($state) => $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('tax')
                    ->label(__('tables/contracts.tax'))
                    ->money('SAR')
                    ->description(__('tables/contracts.currency'))
                    ->formatStateUsing(fn ($state) => $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('tables/contracts.created_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('tables/contracts.updated_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label(__('admin.contracts.download'))
                    ->url(fn ($record) => route('website.download-contract', ['token' => $record->token]))
                    ->icon('heroicon-o-arrow-down-tray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContracts::route('/'),
            'create' => Pages\CreateContract::route('/create'),
            'edit' => Pages\EditContract::route('/{record}/edit'),
        ];
    }
}
