<?php

namespace App\Livewire;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Widgets\Widget;

class Filters extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'livewire.filters';
    public ?string $from = null;
    public ?string $to = null;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    DatePicker::make('from')->label('بداية من تاريخ')
                        ->live()
                        ->afterStateUpdated(function (Set $set, $state) {
                            $this->dispatch('updateFromDate', from: $state);
                        }),
                    DatePicker::make('to')->label('الي تاريخ')
                        ->live()
                        ->afterStateUpdated(function (Set $set, $state) {
                            $this->dispatch('updateToDate', to: $state);
                        })
                ])->columns(3),
            ]);
    }
}

