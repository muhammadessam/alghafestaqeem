<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\RequestRate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusRequest;
use App\Interfaces\RateRequestRepositoryInterface;

class RateRequestsController extends Controller
{
    private RateRequestRepositoryInterface $rateRepository;

    public function __construct(RateRequestRepositoryInterface $rateRepository)
    {
        $this->rateRepository = $rateRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:rates.index')->only(['index']);
        $this->middleware('checkPermission:rates.show')->only(['show']);
        $this->middleware('checkPermission:rates.edit')->only(['edit']);
        $this->middleware('checkPermission:rates.delete')->only(['destroy']);
        $this->middleware('checkPermission:rates.create')->only(['create']);
        $this->middleware('checkPermission:rates.changeStatus')->only(['change-status']);
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->rateRepository->getCount();
        $items = $this->rateRepository->getPaginateRateRequests($data);
        $statuses = Constants::Statuses;
        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
            'statuses' => $statuses
        ];
        return view(
            'admin.rates.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->rateRepository->getRateRequestById($id);
        return view('admin.rates.show', compact('item'));
    }

    public function edit($id)
    {
        $item = $this->rateRepository->getRateRequestById($id);
        $statuses = Constants::Statuses;
        return view('admin.rates.create_and_edit', compact('item', 'statuses'));
    }

    public function update(RequestRate $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $this->rateRepository->updateRateRequest($id, $data);

        return redirect()->route('admin.rates.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->rateRepository->deleteRateRequest($id);

        return redirect()->route('admin.rates.index')
            ->with('message', __('admin.DeletedMessage'));
    }

    public function changeStatus(ChangeStatusRequest $request, $id)
    {
        $data = ['status' => $request->status];
        $this->rateRepository->updateRateRequest($id, $data);

        return redirect()->route('admin.rates.index')
            ->with('message', __('admin.UpdatedMessage'));
    }
}
