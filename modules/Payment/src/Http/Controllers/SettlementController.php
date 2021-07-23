<?php

namespace Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Payment\Http\Requests\SettlementRequest;
use Payment\Repositories\SettlementRepo;
use Payment\Services\SettlementService;

class SettlementController extends Controller
{
    public $SettlementRepo;

    public function __construct(SettlementRepo $settlementRepo)
    {
        $this->SettlementRepo = $settlementRepo;
    }

    public function index()
    {
        $settlements = $this->SettlementRepo->paginate();
        return view('Payment::settlements.index', compact('settlements'));
    }

    public function create()
    {
        if ($this->SettlementRepo->getLatestPendingSettlement(auth()->id())) {

            newFeedback("ناموفق", "شما یک درخواست تسویه در حال انتظار دارید", "error");
            return redirect()->route("settlements.index");
        }
        return view('Payment::settlements.create');
    }


    public function store(SettlementRequest $request)
    {
        if ($this->SettlementRepo->getLatestPendingSettlement(auth()->id())) {
            newFeedback("ناموفق", "شما یک درخواست تسویه در حال انتظار دارید", "error");
            return redirect()->route("settlements.index");
        }
        SettlementService::store($request->all());
        return redirect()->route('settlements.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $requestedSettlement = $this->SettlementRepo->findById($id);
        $settlement = $this->SettlementRepo->getLatestSettlement($requestedSettlement->user_id);
        if ($settlement->id != $id) {
            newFeedback("ناموفق", "این درخواست تسویه قابل ویرایش نمی باشد و بایگانی شده است", "error");
            return redirect()->route("settlements.index");
        }
        return view('Payment::settlements.edit', compact('settlement'));
    }


    public function update(SettlementRequest $request, $id)
    {

        $requestedSettlement = $this->SettlementRepo->findById($id);
        $settlement = $this->SettlementRepo->getLatestSettlement($requestedSettlement->user_id);
        if ($settlement->id != $id) {
            newFeedback("ناموفق", "این درخواست تسویه قابل ویرایش نمی باشد و بایگانی شده است", "error");
            return redirect()->route("settlements.index");
        }

        SettlementService::update($id, $request->all());
        return redirect()->route('settlements.index');
    }

    public function destroy($id)
    {
        //
    }
}
