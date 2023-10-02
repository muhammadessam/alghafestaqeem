<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class EvaluationTransactionTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')->striped()->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return EvaluationTransaction::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('evaluation_company_id')
            ->addColumn('evaluation_employee_id')
            ->addColumn('instrument_number')
            ->addColumn('transaction_number')
            ->addColumn('is_iterated')
            ->addColumn('date_formatted', fn (EvaluationTransaction $model) => Carbon::parse($model->date)->format('d/m/Y'))
            ->addColumn('owner_name')
            ->addColumn('type_id')
            ->addColumn('region')
            ->addColumn('previewer_id')
            ->addColumn('review_id')
            ->addColumn('income_id')
            ->addColumn('city_id')
            ->addColumn('notes')
            ->addColumn('status')
            ->addColumn('review_fundoms')
            ->addColumn('company_fundoms')
            ->addColumn('phone')
            ->addColumn('created_at_formatted', fn (EvaluationTransaction $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(trans('admin.instrument_number'), 'instrument_number')->sortable()->searchable(),
            Column::make(trans('admin.transaction_number'), 'transaction_number')->sortable()->searchable(),
            Column::make('Evaluation company id', 'evaluation_company_id'),
            Column::make('Evaluation employee id', 'evaluation_employee_id'),
            Column::make('Is iterated', 'is_iterated')->toggleable(),

            Column::make('Date', 'date_formatted', 'date')->sortable(),

            Column::make('Owner name', 'owner_name')
                ->sortable()
                ->searchable(),

            Column::make('Type id', 'type_id'),
            Column::make('Region', 'region')
                ->sortable()
                ->searchable(),

            Column::make('Previewer id', 'previewer_id'),
            Column::make('Review id', 'review_id'),
            Column::make('Income id', 'income_id'),
            Column::make('City id', 'city_id'),
            Column::make('Notes', 'notes')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status'),
            Column::make('Review fundoms', 'review_fundoms'),
            Column::make('Company fundoms', 'company_fundoms'),
            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('instrument_number')->operators(['contains']),
            Filter::inputText('transaction_number')->operators(['contains']),
            Filter::boolean('is_iterated'),
            Filter::datepicker('date'),
            Filter::inputText('owner_name')->operators(['contains']),
            Filter::inputText('region')->operators(['contains']),
            Filter::inputText('phone')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(\App\Models\Evaluation\EvaluationTransaction $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
