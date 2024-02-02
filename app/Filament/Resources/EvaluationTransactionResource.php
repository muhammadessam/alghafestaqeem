<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationTransactionResource\Pages;
use App\Filament\Resources\EvaluationTransactionResource\RelationManagers;
use App\Helpers\Constants;
use App\Models\Evaluation\EvaluationTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluationTransactionResource extends Resource
{
    protected static ?string $model = EvaluationTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('instrument_number')
                    ->label(__('forms\evaluation_transaction.instrument_number'))
                    ->reactive()
                    ->helperText(function (callable $get) {
                        $exists = EvaluationTransaction::where('instrument_number', $get('instrument_number'))->exists();
                        if ($exists)
                            return "رقم الصك هذا مستخدم مسبقاً";
                        return "";
                    })
                    ->required(),
                Forms\Components\TextInput::make("transaction_number")
                    ->label(__('forms\evaluation_transaction.transaction_number'))
                    ->required(),
                Forms\Components\TextInput::make("owner_name")
                    ->label(__('forms\evaluation_transaction.owner_name'))
                    ->required(),
                Forms\Components\Select::make('new_city_id')
                    ->label(__('forms\evaluation_transaction.new_city_id'))
                    ->relationship('newCity', fn () => app()->getLocale() == 'ar' ? 'name_ar' : 'name_en')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('plan_no')
                    ->label(__('forms\evaluation_transaction.plan_no'))
                    ->required(),
                Forms\Components\TextInput::make('plot_no')
                    ->label(__('forms\evaluation_transaction.plot_no'))
                    ->reactive()
                    ->helperText(function (callable $get) {
                        $exists = EvaluationTransaction::where('new_city_id', '!=', null)
                            ->where('new_city_id', $get('new_city_id'))
                            ->where('plan_no', '!=', null)
                            ->where('plan_no', $get('plan_no'))
                            ->where('plot_no', '!=', null)
                            ->where('plot_no', $get('plot_no'))
                            ->exists();

                        if ($exists)
                            return "توجد معاملة بنفس العنوان (المدينة، رقم المخطط، رقم القطعة)";

                        if ($get('new_city_id') == null || $get('plan_no') == null || $get('plot_no') == null)
                            return "";

                        return "يمكنك استخدام هذا العنوان (المدينة، رقم المخطط، رقم القطعة)";
                    })
                    ->required(),
                Forms\Components\Select::make('type_id')
                    ->label(__('forms\evaluation_transaction.type_id'))
                    ->relationship('type', 'title', fn (Builder $query) => $query->where('type', Constants::ApartmentType))
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('evaluation_company_id')
                    ->label(__('forms\evaluation_transaction.evaluation_company_id'))
                    ->relationship('company', 'title')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('evaluation_employee_id')
                    ->label(__('forms\evaluation_transaction.evaluation_employee_id'))
                    ->relationship('employee', 'title')
                    ->preload()
                    ->searchable(),
                Forms\Components\DatePicker::make('date')
                    ->label(__('forms\evaluation_transaction.date'))
                    ->native(false)
                    ->required(),
                Forms\Components\Fieldset::make('preview_fieldset')
                    ->label(__('forms\evaluation_transaction.preview_fieldset'))
                    ->schema([
                        Forms\Components\Select::make('previewer_id')
                            ->label(__('forms\evaluation_transaction.previewer_id'))
                            ->relationship('previewer', 'title')
                            ->preload()
                            ->searchable(),
                        Forms\Components\DateTimePicker::make('preview_date_time')
                            ->label(__('forms\evaluation_transaction.preview_date_time'))
                            ->native(false)
                            ->seconds(false),
                    ]),
                Forms\Components\Fieldset::make('review_fieldset')
                    ->label(__('forms\evaluation_transaction.review_fieldset'))
                    ->schema([
                        Forms\Components\Select::make('review_id')
                            ->label(__('forms\evaluation_transaction.review_id'))
                            ->relationship('review', 'title')
                            ->preload()
                            ->searchable(),
                        Forms\Components\DateTimePicker::make('review_date_time')
                            ->label(__('forms\evaluation_transaction.review_date_time'))
                            ->native(false)
                            ->seconds(false),
                    ]),
                Forms\Components\Fieldset::make('income_fieldset')
                    ->label(__('forms\evaluation_transaction.income_fieldset'))
                    ->schema([
                        Forms\Components\Select::make('income_id')
                            ->label(__('forms\evaluation_transaction.income_id'))
                            ->relationship('previewer', 'title')
                            ->preload()
                            ->searchable(),
                        Forms\Components\DateTimePicker::make('income_date_time')
                            ->label(__('forms\evaluation_transaction.income_date_time'))
                            ->native(false)
                            ->seconds(false),
                    ]),
                Forms\Components\Textarea::make('notes')
                    ->label(__('forms\evaluation_transaction.notes'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('company_fundoms')
                    ->label(__('forms\evaluation_transaction.company_compensation'))
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\TextInput::make('review_fundoms')
                    ->label(__('forms\evaluation_transaction.company_compensation'))
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\TextInput::make('phone')
                    ->label(__('forms\evaluation_transaction.phone'))
                    ->required(),
                Forms\Components\FileUpload::make('files')
                    ->label(__('forms\evaluation_transaction.files'))
                    ->directory('transaction')
                    ->multiple()
                    ->openable()
                    ->downloadable()
                    ->previewable()
                    ->visible(function (string $context) {
                        // TODO: Show files in edit with ability to delete
                        return $context == 'create';
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        // Column::make(trans('admin.is_iterated'), 'is_iterated_formatted', 'is_iterated')->visibleInExport(false)->sortable()->headerAttribute('text-right'),
        // Column::make(trans('admin.Status'), 'status_excel')->hidden(true)->visibleInExport(true)->headerAttribute('text-right'),
        // Column::make(trans('admin.is_iterated'), 'is_iterated_excel')->hidden(true)->visibleInExport(true)->headerAttribute('text-right'),
        // Column::make(trans('admin.Status'), 'status_formatted', 'status')->sortable()->visibleInExport(false)->headerAttribute('text-right'),
        // Column::make(trans('admin.LastUpdate'), 'updated_at_formatted', 'updated_at')->sortable()->headerAttribute('text-right'),
        // Column::make(trans('admin.notes'), 'notes')->headerAttribute('text-right'),
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('instrument_number')
                    ->label('tables/evaluation_transaction.instrument_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_number')
                    ->label('tables/evaluation_transaction.transaction_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('tables/evaluation_transaction.phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company')
                    ->label('tables/evaluation_transaction.company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region')
                    ->label('tables/evaluation_transaction.region')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company_fundoms')
                    ->label('tables/evaluation_transaction.company_fundoms'),
                Tables\Columns\TextColumn::make('review_fundoms')
                    ->label('tables/evaluation_transaction.review_fundoms'),
                Tables\Columns\TextColumn::make('previewer')
                    ->label('tables/evaluation_transaction.previewer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TransactionDetail')
                    ->label('tables/evaluation_transaction.TransactionDetail'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEvaluationTransactions::route('/'),
            'create' => Pages\CreateEvaluationTransaction::route('/create'),
            'edit' => Pages\EditEvaluationTransaction::route('/{record}/edit'),
        ];
    }
}
