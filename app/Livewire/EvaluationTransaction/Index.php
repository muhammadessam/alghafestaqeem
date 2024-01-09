<?php

namespace App\Livewire\EvaluationTransaction;

use App\Models\Category;
use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component implements HasForms
{

    use  InteractsWithForms;

    public bool $is_daily = false;
    public ?EvaluationTransaction $selected = null;
    public $company = null;
    public $city_id = null;
    public $evaluation_company_id = null;
    public $review_id = null;
    public $income_id = null;
    public $previewer_id = null;
    public $notes = null;
    public $status = null;
    public bool $details_modal = false;
    public bool $status_modal = false;

    protected $listeners = ['edit', 'editStatus'];

    public function mount($company = null): void
    {
        $this->company = $company;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('city_id')
                ->label(trans('admin.city'))
                ->searchable()
                ->live()
                ->options(Category::where('type', 4)->pluck('title', 'id'))
                ->preload(),

            Select::make('evaluation_company_id')
                ->label(trans('admin.EvaluationCompanies'))
                ->live()
                ->options(EvaluationCompany::all()->pluck('title', 'id'))
                ->preload()
                ->searchable(),

            Select::make('review_id')
                ->label(trans('admin.review'))
                ->live()
                ->options(EvaluationEmployee::all()->pluck('title', 'id'))
                ->preload()
                ->searchable(),

            Select::make('income_id')
                ->label(trans('admin.income'))
                ->live()
                ->options(EvaluationEmployee::all()->pluck('title', 'id'))
                ->preload()
                ->searchable(),

            Select::make('previewer_id')
                ->label(trans('admin.previewer'))
                ->live()
                ->options(EvaluationEmployee::all()->pluck('title', 'id'))
                ->preload()
                ->searchable(),

            TextInput::make('notes')->live()->label(trans('admin.notes')),

        ]);
    }

    public function editStatus(EvaluationTransaction $model): void
    {
        if ($model->status != 4 || auth()->user()->hasRole('super-admin')) {
            $this->selected = $model;
            $this->status = $model->status;
            $this->status_modal = true;
            $this->dispatch('open-modal', id: 'edit-status');
        } else {
            Notification::make()->title('لا يمكنك التعديل')->danger()->body('التعديل غير مسموح بعد اكتمال الحال')->send();
        }

    }

    public function edit(EvaluationTransaction $model): void
    {
        if ($model->status != 4 || auth()->user()->hasRole('super-admin')) {
            $this->fill($model);
            $this->selected = $model;
            $this->dispatch('open-modal', id: 'edit-details');
        } else {
            Notification::make()->title('لا يمكنك التعديل')->danger()->body('التعديل غير مسموح بعد اكتمال الحال')->send();
        }
    }

    public
    function save(): void
    {
        $this->selected->update([
            'city_id' => $this->city_id,
            'evaluation_company_id' => $this->evaluation_company_id,
            'review_id' => $this->review_id,
            'income_id' => $this->income_id,
            'previewer_id' => $this->previewer_id,
            'notes' => $this->notes,
            'status' => $this->status,
        ]);
        $this->dispatch('updatedData')->to('transaction-table');
        $this->reset(['city_id', 'selected', 'review_id', 'income_id', 'previewer_id', 'evaluation_company_id', 'notes']);
        $this->dispatch('close-modal', id: 'edit-details');
        Notification::make()->title('تم الحفظ بنجاح')
            ->success()->body('تم حفظ تفاصيل المعاملة بنجاح')->send();
    }

    public
    function updatedPreviewerId($value): void
    {
        if ($value != null and $this->selected->previewer_id == null) {
            $this->status = 3;
        }
        if ($value == null) {
            $this->status = 0;
        }
    }

    public
    function updatedReviewId($value): void
    {
        if ($value != null and $this->selected->review_id == null)
            $this->status = 4;
        if ($value == null and $this->previewer_id != null)
            $this->status = 3;
    }

    public
    function updateStatus(): void
    {
        $this->selected->update([
            'status' => $this->status
        ]);
        $this->dispatch('updatedData')->to('transaction-table');
        $this->reset(['city_id', 'selected', 'review_id', 'details_modal', 'income_id', 'previewer_id', 'evaluation_company_id', 'notes', 'status_modal']);
        $this->dispatch('close-modal', id: 'edit-status');
        Notification::make()->title('تم الحفظ بنجاح')
            ->success()
            ->body('تم حفظ الحالة بنجاح')->send();
    }

    public
    function render(): View
    {
        return view('livewire.evaluation-transaction.index');
    }
}
