<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class TransactionTable extends PowerGridComponent
{
    use WithExport;

    public string $sortDirection = 'desc';
    public $new_data = null;
    public array $my_filters = [
        'text' => null,
        'employee_id' => null,
        'company_id' => null,
        'status' => null,
        'city_id' => null,
        'from_date' => null,
        'to_date' => null,
    ];

    public function updated($property): void
    {
        $this->new_data = $this->datasource()->where(
            fn(EloquentBuilder|QueryBuilder $query) => \PowerComponents\LivewirePowerGrid\DataSource\Builder::make($query, $this)
                ->filterContains()
        )->get();
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')->striped()->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->includeViewOnBottom('components.filters.employee'),
            Footer::make()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return EvaluationTransaction::query()->filters($this->my_filters)->with(['city', 'review', 'company', 'previewer', 'income']);
    }

    public function relationSearch(): array
    {
        return [
            'city' => ['title'],
            'review' => ['title'],
            'company' => ['title'],
            'previewer' => ['title'],
            'income' => ['title'],
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('id_formatted', function (EvaluationTransaction $model) {
                return $model->id . '<br/>' . Carbon::parse($model->created_at)->format('d/m/Y');
            })->addColumn('instrument_number')
            ->addColumn('transaction_number')
            ->addColumn('phone')
            ->addColumn('evaluation_company_id')
            ->addColumn('evaluation_company_id_formatted', fn(EvaluationTransaction $model) => $model->company->title ?? '')
            ->addColumn('region')
            ->addColumn('company_fundoms')
            ->addColumn('review_fundoms')
            ->addColumn('previewer_id')
            ->addColumn('previewer_id_formatted', fn(EvaluationTransaction $model) => $model->previewer->title ?? '')
            ->addColumn('is_iterated')
            ->addColumn('is_iterated_formatted', function (EvaluationTransaction $model) {
                return $model->is_iterated ? '<span class="badge badge-danger bg-danger text-black px-2">نعم</span>' : '<span class="badge badge-success bg-success text-black px-2">لا</span>';
            })
            ->addColumn('status')
            ->addColumn('status_formatted', function (EvaluationTransaction $model) {
                if ($model->status == 0) {
                    return __('admin.NewTransaction');
                } elseif ($model->status == 1) {
                    return __('admin.InReviewRequest');
                } elseif ($model->status == 2) {
                    return __('admin.ContactedRequest');
                } elseif ($model->status == 3) {
                    return __('admin.ReviewedRequest');
                } elseif ($model->status == 4) {
                    return __('admin.FinishedRequest');
                } elseif ($model->status == 5) {
                    return __('admin.PendingRequest');
                } elseif ($model->status == 6) {
                    return __('admin.Cancelled');
                } else {
                    return '';
                }
            })->addColumn('details', function (EvaluationTransaction $model) {
                return view('components.transaction_details', ['model' => $model]);
            })
            ->addColumn('updated_at')
            ->addColumn('updated_at_formatted', fn(EvaluationTransaction $model) => Carbon::parse($model->updated_at)->format('d/m/Y'))
            ->addColumn('owner_name')
            ->addColumn('review_id')
            ->addColumn('review_id_formatted', fn(EvaluationTransaction $model) => $model->review->title ?? '')
            ->addColumn('income_id')
            ->addColumn('income_id_formatted', fn(EvaluationTransaction $model) => $model->income->title ?? '')
            ->addColumn('city_id')
            ->addColumn('city_id_formatted', fn(EvaluationTransaction $model) => $model->city->title ?? '')
            ->addColumn('notes');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id_formatted', 'id'),
            Column::make(trans('admin.instrument_number'), 'instrument_number')->sortable()->searchable(),
            Column::make(trans('admin.transaction_number'), 'transaction_number')->sortable()->searchable(),
            Column::make(trans('admin.phone'), 'phone')->searchable(),
            Column::make(trans('admin.company'), 'evaluation_company_id_formatted', 'evaluation_company_id'),
            Column::make(trans('admin.region'), 'region', 'region')->sortable()->searchable(),
            Column::make(trans('admin.review_fundoms'), 'review_fundoms'),
            Column::make(trans('admin.company_fundoms'), 'company_fundoms'),
            Column::make(trans('admin.previewer'), 'previewer_id_formatted')->searchable(),
            Column::add()->title(trans('admin.TransactionDetail'))->field('details'),
            Column::make(trans('admin.is_iterated'), 'is_iterated_formatted', 'is_iterated')->sortable(),
            Column::make(trans('admin.Status'), 'status_formatted'),
            Column::make(trans('admin.LastUpdate'), 'updated_at_formatted')->sortable(),
            Column::make(trans('admin.notes'), 'notes'),

            Column::action(trans('admin.Actions'))
        ];
    }

    public function actions(EvaluationTransaction $row): array
    {
        return [
            Button::add('show')
                ->slot('<i class="fa fa-eye"></i>')
                ->class('pg-btn-white text-warning dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('admin.evaluation-transactions.show', ['evaluation_transaction' => $row->id]),
            Button::add('edit')
                ->slot('<i class="fa fa-edit"></i>')
                ->class('pg-btn-white text-secondary dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('admin.evaluation-transactions.edit', ['evaluation_transaction' => $row->id]),
            Button::add('delete')
                ->bladeComponent('delete-form', ['id' => $row->id])
        ];
    }


    public function actionRules(): array
    {
        return [
            // Hide button edit for ID 1
            Rule::rows()
                ->when(fn($model) => $model->is_iterated == true)
                ->setAttribute('class', 'bg-danger'),
        ];
    }

}
