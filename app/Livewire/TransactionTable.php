<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
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
use Throwable;

final class TransactionTable extends PowerGridComponent implements HasForms
{
    use WithExport, InteractsWithForms;

    public string $sortDirection = 'desc';
    public $new_data = null;
    public ?int $company;
    public bool $edit_modal = false;
    public string $loadingComponent = 'components.my-custom-loading';

    public bool $is_daily = false;

    protected function getListeners()
    {
        return array_merge([
            'updateStatus', 'updatedData'
        ], parent::getListeners());
    }

    public array $my_filters = [
        'text' => null,
        'employee_id' => null,
        'company_id' => [],
        'status' => null,
        'city_id' => null,
        'from_date' => null,
        'to_date' => null,
        'transaction_number' => null
    ];

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('transaction_number')->label(trans('admin.transaction_number'))->live(),
            Select::make('employee_id')
                ->label(trans('admin.employee'))
                ->live()
                ->searchable(true)
                ->preload()
                ->options(EvaluationEmployee::all()->pluck('title', 'id')),
            Select::make('company_id')
                ->multiple()
                ->searchable()
                ->label(trans('admin.company'))
                ->options(EvaluationCompany::all()->pluck('title', 'id'))
                ->live()
                ->hidden(fn () => isset($this->company)),
            Select::make('status')
                ->label(trans('admin.Status'))
                ->live()
                ->nullable(true)
                ->searchable()
                ->options([
                    0 => trans('admin.NewTransaction'),
                    1 => trans('admin.InReviewRequest'),
                    2 => trans('admin.ContactedRequest'),
                    3 => trans('admin.ReviewedRequest'),
                    4 => trans('admin.FinishedRequest'),
                    5 => trans('admin.PendingRequest'),
                    6 => trans('admin.Cancelled'),
                ])->default(null),
            Select::make('city_id')
                ->label(trans('admin.city'))
                ->live()->options(\App\Models\Category::where('type', \App\Helpers\Constants::CityType)
                    ->select(['id', 'title'])
                    ->pluck('title', 'id')->toArray()),
            DatePicker::make('from_date')
                ->label(trans('admin.LastUpdate') . ' من')
                ->live()
                ->hidden(fn () => $this->is_daily),
            DatePicker::make('to_date')
                ->label(trans('admin.LastUpdate') . ' الي')
                ->live()
                ->hidden(fn () => $this->is_daily)
        ])->statePath('my_filters')->columns(5);
    }

    public function updatedMyFilters($value, $key): void
    {
        $this->gotoPage(1);
    }

    /**
     * @throws Throwable
     */
    public function updatedData(): void
    {
        $this->fillData();
    }

    public function updated($property): void
    {
        $this->new_data = $this->datasource()->where(
            fn (EloquentBuilder|QueryBuilder $query) => \PowerComponents\LivewirePowerGrid\DataSource\Builder::make($query, $this)
                ->filterContains()
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
            $query->where('evaluation_company_id', $this->company);
        }
        if ($this->is_daily) {
            $query->whereDate('created_at', today()->toDateString());
        }
        return $query->filters($this->my_filters)->with(['city', 'review', 'company', 'previewer', 'income']);
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
            ->addColumn('evaluation_company_id_formatted', fn (EvaluationTransaction $model) => $model->company->title ?? '')
            ->addColumn('region')
            ->addColumn('company_fundoms')
            ->addColumn('review_fundoms')
            ->addColumn('previewer_id')
            ->addColumn('previewer_id_formatted', fn (EvaluationTransaction $model) => $model->previewer->title ?? '')
            ->addColumn('is_iterated', function (EvaluationTransaction $model) {
                return EvaluationTransaction::where('instrument_number', $model->instrument_number)->where('id', '!=', $model->id)->count();
            })
            ->addColumn('is_iterated_formatted', function (EvaluationTransaction $model) {
                return $model->is_iterated ? '<span class="badge badge-danger bg-danger text-black px-2">نعم</span>' : '<span class="badge badge-success bg-success text-black px-2">لا</span>';
            })
            ->addColumn('is_iterated_excel', function (EvaluationTransaction $model) {
                return $model->is_iterated ? 'نعم' : 'لا';
            })
            ->addColumn('status')
            ->addColumn('status_formatted', function (EvaluationTransaction $model) {
                $status = '';
                if ($model->status == 0) {
                    $status = __('admin.NewTransaction');
                } elseif ($model->status == 1) {
                    $status = __('admin.InReviewRequest');
                } elseif ($model->status == 2) {
                    $status = __('admin.ContactedRequest');
                } elseif ($model->status == 3) {
                    $status = __('admin.ReviewedRequest');
                } elseif ($model->status == 4) {
                    $status = __('admin.FinishedRequest');
                } elseif ($model->status == 5) {
                    $status = __('admin.PendingRequest');
                } elseif ($model->status == 6) {
                    $status = __('admin.Cancelled');
                }
                return view('components.status_change', [
                    'model' => $model,
                    'status' => $status
                ]);
            })->addColumn('status_excel', function (EvaluationTransaction $model) {
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
            ->addColumn('updated_at_formatted', fn (EvaluationTransaction $model) => Carbon::parse($model->updated_at)->format('Y-m-d'))
            ->addColumn('owner_name')
            ->addColumn('review_id')
            ->addColumn('review_id_formatted', fn (EvaluationTransaction $model) => $model->review->title ?? '')
            ->addColumn('income_id')
            ->addColumn('income_id_formatted', fn (EvaluationTransaction $model) => $model->income->title ?? '')
            ->addColumn('city_id')
            ->addColumn('city_id_formatted', fn (EvaluationTransaction $model) => $model->city->title ?? '')
            ->addColumn('notes');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id_formatted', 'id')->headerAttribute('text-right'),
            Column::make('Id', 'id', 'id')->visibleInExport(true)->hidden(true)->headerAttribute('text-right'),
            Column::make(trans('admin.instrument_number'), 'instrument_number')->sortable()->searchable()->headerAttribute('text-right'),
            Column::make(trans('admin.transaction_number'), 'transaction_number')->sortable()->searchable()->headerAttribute('text-right'),
            Column::make(trans('admin.phone'), 'phone')->searchable()->headerAttribute('text-right'),
            Column::make(trans('admin.company'), 'evaluation_company_id_formatted', 'evaluation_company_id')->sortable()->headerAttribute('text-right'),
            Column::make(trans('admin.region'), 'region_attribute', 'region')->sortable()->searchable()->headerAttribute('text-right'),
            Column::make(trans('admin.company_fundoms'), 'company_fundoms')->headerAttribute('text-right'),
            Column::make(trans('admin.review_fundoms'), 'review_fundoms')->headerAttribute('text-right'),
            Column::make(trans('admin.previewer'), 'previewer_id_formatted')->searchable()->headerAttribute('text-right'),
            Column::make(trans('admin.TransactionDetail'), 'details')->visibleInExport(false)->headerAttribute('text-right'),
            Column::make(trans('admin.is_iterated'), 'is_iterated_formatted', 'is_iterated')->visibleInExport(false)->sortable()->headerAttribute('text-right'),
            Column::make(trans('admin.Status'), 'status_excel')->hidden(true)->visibleInExport(true)->headerAttribute('text-right'),
            Column::make(trans('admin.is_iterated'), 'is_iterated_excel')->hidden(true)->visibleInExport(true)->headerAttribute('text-right'),
            Column::make(trans('admin.Status'), 'status_formatted', 'status')->sortable()->visibleInExport(false)->headerAttribute('text-right'),
            Column::make(trans('admin.LastUpdate'), 'updated_at_formatted', 'updated_at')->sortable()->headerAttribute('text-right'),
            Column::make(trans('admin.notes'), 'notes')->headerAttribute('text-right'),
            Column::action(trans('admin.Actions'))->headerAttribute('text-right')
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
            Rule::button('show')
                ->when(function ($model) {
                    return !auth()->user()->can('evaluation-transactions.show') and !auth()->user()->hasRole('super-admin');
                })->hide(),
            Rule::button('edit')
                ->when(function ($model) {
                    return ($model->status == 4 and !auth()->user()->hasRole('super-admin')) || (!auth()->user()->can('evaluation-transactions.edit') and !auth()->user()->hasRole('super-admin'));
                })->hide(),
            Rule::button('delete')
                ->when(function ($model) {
                    return !auth()->user()->can('evaluation-transactions.destroy') and !auth()->user()->hasRole('super-admin');
                })->hide(),

            // Hide button edit for ID 1
            Rule::rows()->when(fn ($model) => $model->is_iterated == true)->setAttribute('class', 'bg-danger'),
        ];
    }
}
