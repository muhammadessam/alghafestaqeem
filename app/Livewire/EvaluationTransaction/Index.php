<?php

namespace App\Livewire\EvaluationTransaction;

use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{

    use  Actions;
    public bool $is_daily= false;
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

    public function editStatus(EvaluationTransaction $model): void
    {
        if ($model->status != 4 || auth()->user()->hasRole('super-admin')) {
            $this->selected = $model;
            $this->status = $model->status;
            $this->status_modal = true;
        } else {
            $this->notification()->error('لا يمكنك التعديل', 'التعديل غير مسموح بعد اكتمال الحال');
        }

    }

    public function edit(EvaluationTransaction $model): void
    {
        if ($model->status != 4 || auth()->user()->hasRole('super-admin')) {
            $this->fill($model);
            $this->selected = $model;
            $this->details_modal = true;
        } else {
            $this->notification()->error('لا يمكنك التعديل', 'التعديل غير مسموح بعد اكتمال الحال');
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
        $this->reset(['city_id', 'selected', 'review_id', 'details_modal', 'income_id', 'previewer_id', 'evaluation_company_id', 'notes', 'status_modal']);
        $this->notification()->success('تم الحفظ بنجاح', 'تم حفظ تفاصيل المعاملة بنجاح');
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
        $this->notification()->success('تم الحفظ بنجاح', 'تم حفظ الحالة بنجاح');
    }

    public
    function render(): View
    {
        return view('livewire.evaluation-transaction.index');
    }
}
