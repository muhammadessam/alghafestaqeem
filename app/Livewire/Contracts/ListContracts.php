<?php

namespace App\Livewire\Contracts;

use App\Models\Contract;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListContracts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Contract::query())
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
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
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
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.contracts.list-contracts');
    }
}
