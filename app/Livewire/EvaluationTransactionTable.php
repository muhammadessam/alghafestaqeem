<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
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

    public string $sortDirection = 'desc';
    public string $primaryKey = 'evaluation_transactions.id';
    public int $company;
    public $new_data = null;

    public function updated($property)
    {
        $this->new_data = $this->datasource()->where(
            fn(EloquentBuilder|QueryBuilder $query) => \PowerComponents\LivewirePowerGrid\DataSource\Builder::make($query, $this)
                ->filter()
        )->get();
    }

    public function setUp(): array
    {
        $this->showCheckBox();
        return [
            Exportable::make(now()->toDateString())->striped()->type(Exportable::TYPE_XLS)->deleteFileAfterSend(true),
            Header::make()->showSearchInput()->includeViewOnBottom('components.filters.employee'),
            Footer::make()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $query = EvaluationTransaction::query();
        if (isset($this->company)) {
            $query = $query->where('evaluation_company_id', $this->company);
        }
        return $query
            ->with(['city', 'income', 'review'])
            ->join('evaluation_companies', function ($query) {
                $query->on('evaluation_transactions.evaluation_company_id', '=', 'evaluation_companies.id');
            })->join('evaluation_employees', function ($query) {
                $query->on('evaluation_transactions.previewer_id', '=', 'evaluation_employees.id');
            })->join('categories', function ($query) {
                $query->on('evaluation_transactions.city_id', '=', 'categories.id');
            })->select([
                'evaluation_transactions.id',
                'evaluation_transactions.instrument_number',
                'evaluation_transactions.transaction_number',
                'evaluation_transactions.phone',
                'evaluation_transactions.region',
                'evaluation_transactions.company_fundoms',
                'evaluation_transactions.review_fundoms',
                'evaluation_transactions.owner_name',
                'evaluation_transactions.is_iterated',
                'evaluation_transactions.city_id',
                'evaluation_transactions.type_id',
                'evaluation_transactions.status',
                'evaluation_transactions.notes',
                'evaluation_transactions.updated_at',
                'evaluation_transactions.evaluation_employee_id',
                'evaluation_transactions.review_id',
                'evaluation_transactions.income_id',
                'evaluation_transactions.city_id',
                'evaluation_transactions.previewer_id',

                'evaluation_companies.id as evaluation_company_id',
                'evaluation_employees.title as previewer_name',
                'evaluation_companies.title as company_title',
            ]);
    }

    public function relationSearch(): array
    {
        return [
            'company' => [
                'title',
            ]
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('instrument_number')
            ->addColumn('transaction_number')
            ->addColumn('phone')
            ->addColumn('city_id', function (EvaluationTransaction $model) {
                return view('components.transaction_details', ['model' => $model]);
            })
            ->addColumn('region')
            ->addColumn('company_fundoms')
            ->addColumn('review_fundoms')
            ->addColumn('category_title')
            ->addColumn('previewer_name')
            ->addColumn('evaluation_employee_id', fn(EvaluationTransaction $model) => $model->employee->title ?? '')
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
            Column::make(trans('admin.phone'), 'phone', 'evaluation_transactions.phone')->searchable(),
            Column::make(trans('admin.company'), 'company_title', 'evaluation_companies.title')->sortable()->searchable(),
            Column::make(trans('admin.region'), 'region')->searchable(),
            Column::make(trans('admin.company_fundoms'), 'company_fundoms'),
            Column::make(trans('admin.review_fundoms'), 'review_fundoms'),
            Column::make(trans('admin.previewer'), 'previewer_name', 'evaluation_employees.title')->sortable()->searchable(),
            Column::make(trans('admin.employee'), 'evaluation_employee_id')->sortable()->searchable()->visibleInExport(false),

            Column::make(trans('admin.TransactionDetail'), 'city_id')->visibleInExport(false),

            Column::make(trans('admin.Status'), 'status', 'evaluation_transactions.status')->sortable()->visibleInExport(false),
            Column::make(trans('admin.Status'), 'status_formatted', 'evaluation_transactions.status')->hidden(true)->visibleInExport(true),

            Column::make(trans('admin.is_iterated'), 'is_iterated', 'is_iterated')->sortable(),
            Column::make(trans('admin.LastUpdate'), 'updated_at_formatted', 'evaluation_transactions.updated_at')->sortable(),
            Column::make(trans('admin.notes'), 'notes')->searchable(),
            Column::action(trans('admin.Actions'))
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('instrument_number', 'evaluation_transactions.instrument_number')->operators(['contains']),
            Filter::inputText('transaction_number', 'evaluation_transactions.transaction_number')->operators(['contains']),
            Filter::select('company_title', 'evaluation_company_id')->dataSource(EvaluationCompany::all())->optionValue('id')->optionLabel('title'),
            Filter::boolean('is_iterated')->label('نعم', 'لا'),
            Filter::select('evaluation_employee_id')
                ->dataSource(EvaluationEmployee::all())
                ->optionValue('id')->optionLabel('title')
                ->builder(function (Builder $query, $value) {
                    $query->where(function (Builder $query) use ($value) {
                        $query->where('previewer_id', $value)->orWhere('review_id', $value)->orWhere('income_id', $value);
                    });
                }),
            Filter::datepicker('updated_at_formatted', 'evaluation_transactions.updated_at'),
            Filter::select('status', 'status')->dataSource([
                ['id' => 0, 'name' => trans('admin.NewTransaction')],
                ['id' => 1, 'name' => trans('admin.InReviewRequest')],
                ['id' => 2, 'name' => trans('admin.ContactedRequest')],
                ['id' => 3, 'name' => trans('admin.ReviewedRequest')],
                ['id' => 4, 'name' => trans('admin.FinishedRequest')],
                ['id' => 5, 'name' => trans('admin.PendingRequest')],
                ['id' => 6, 'name' => trans('admin.Cancelled')],
            ])->optionLabel('name')->optionValue('id'),
            Filter::inputText('owner_name')->operators(['contains']),
            Filter::inputText('region')->operators(['contains']),
            Filter::inputText('phone', 'evaluation_transactions.phone')->operators(['contains']),
        ];
    }

    public function actions(\App\Models\Evaluation\EvaluationTransaction $row): array
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
