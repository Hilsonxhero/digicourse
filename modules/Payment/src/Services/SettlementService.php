<?php


namespace Payment\Services;


use Carbon\Carbon;
use Payment\Models\Settlement;
use Payment\Repositories\SettlementRepo;

class SettlementService
{


    public function __construct(SettlementRepo $settlementRepo)
    {

    }

    public static function store($data)
    {
        $repo = new SettlementRepo();
        $repo->store([
            "cart_number" => $data["cart_number"],
            "name" => $data["name"],
            "amount" => $data["amount"],
        ]);

        newFeedback();
        auth()->user()->balance -= $data["amount"];
        auth()->user()->save();
    }

    public static function update(int $settlement, array $request)
    {
        $repo = new SettlementRepo();
        $settlement = $repo->findById($settlement);

        if (!in_array($settlement->status, [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED]) &&
            in_array($request["status"], [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED])) {

            $settlement->user->balance += $settlement->amount;
            $settlement->user->save();
        }



        if (in_array($settlement->status, [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED]) &&
            in_array($request["status"], [Settlement::STATUS_SETTLED, Settlement::STATUS_PENDING])) {
            if ($settlement->user->balance < $settlement->amount) {
                newFeedback("ناموفق", "موجودی حساب کاربری کافی نمی باشد", "error");
                return;
            }
            $settlement->user->balance -= $settlement->amount;
            $settlement->user->save();


        }
        if ($request["status"] == Settlement::STATUS_SETTLED) {
            $settlement->settled_at = Carbon::now();
            $settlement->save();
        }


        newFeedback();
        $repo->update($settlement->id, $request);

    }
}
