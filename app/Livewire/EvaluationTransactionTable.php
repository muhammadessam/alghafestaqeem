<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationCompany;
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
        return EvaluationTransaction::query()->latest()->with(['company', 'employee', 'type', 'previewer', 'review']);
    }

    public function relationSearch(): array
    {
        return ['company' => [
            'title',
        ]];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('instrument_number')
            ->addColumn('transaction_number')
            ->addColumn('phone')
            ->addColumn('evaluation_company_id', fn(EvaluationTransaction $model) => $model->company->title ?? '')
            ->addColumn('region')
            ->addColumn('company_fundoms')
            ->addColumn('evaluation_employee_id')
            ->addColumn('review_fundoms')
            ->addColumn('previewer_id', fn(EvaluationTransaction $model) => $model->previewer->title ?? '')
            ->addColumn('is_iterated', fn(EvaluationTransaction $model) => $model->is_iterated ? 'نعم' : 'لا')
            ->addColumn('status', function (EvaluationTransaction $model) {
                if ($model->status == 0) {
                    return "<span class='badge badge-pill alert-table badge-warning'>" . __('admin.NewTransaction') . "</span>";
                } elseif ($model->status == 1) {
                    return "<span class='badge badge-pill alert-table badge-info'>" . __('admin.InReviewRequest') . "</span>";
                } elseif ($model->status == 2) {
                    return "<span class='badge badge-pill alert-table badge-primary'>" . __('admin.ContactedRequest') . "</span>";
                } elseif ($model->status == 3) {
                    return "<span class='badge badge-pill alert-table badge-danger'>" . __('admin.ReviewedRequest') . "</span>";
                } elseif ($model->status == 4) {
                    return "<span class='badge badge-pill alert-table badge-success'>" . __('admin.FinishedRequest') . "</span>";
                } elseif ($model->status == 5) {
                    return "<span class='badge badge-pill alert-table badge-warning'>" . __('admin.PendingRequest') . "</span>";
                } elseif ($model->status == 6) {
                    return "<span class='badge badge-pill alert-table badge-warning'>" . __('admin.Cancelled') . "</span>";
                } else {
                    return '';
                }
            })
            ->addColumn('notes')
            ->addColumn('updated_at_formatted', fn(EvaluationTransaction $model) => Carbon::parse($model->updated_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(trans('admin.instrument_number'), 'instrument_number')->sortable()->searchable(),
            Column::make(trans('admin.transaction_number'), 'transaction_number')->sortable()->searchable(),
            Column::make(trans('admin.phone'), 'phone')->searchable(),
            Column::make(trans('admin.company'), 'evaluation_company_id')->searchable(),
            Column::make(trans('admin.region'), 'region')->searchable(),
            Column::make(trans('admin.company_fundoms'), 'company_fundoms'),
            Column::make(trans('admin.review_fundoms'), 'review_fundoms'),
            Column::make(trans('admin.previewer'), 'previewer_id'),
            Column::make(trans('admin.is_iterated'), 'is_iterated'),
            Column::make(trans('admin.Status'), 'status'),
            Column::make(trans('admin.LastUpdate'), 'updated_at_formatted', 'updated_at')->sortable(),
            Column::make(trans('admin.notes'), 'notes')->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('instrument_number')->operators(['contains']),
            Filter::inputText('transaction_number')->operators(['contains']),
            Filter::multiSelect('evaluation_company_id')
                ->dataSource(EvaluationCompany::all())
                ->optionValue('id')
                ->optionLabel('title'),
            Filter::boolean('is_iterated')->label('نعم', 'لا'),
            Filter::datepicker('updated_at'),
            Filter::inputText('owner_name')->operators(['contains']),
            Filter::inputText('region')->operators(['contains']),
            Filter::inputText('phone')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\Evaluation\EvaluationTransaction $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
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
