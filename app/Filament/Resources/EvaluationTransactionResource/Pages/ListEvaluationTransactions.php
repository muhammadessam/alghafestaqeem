<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationTransactions extends ListRecords
{
    protected static string $resource = EvaluationTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
