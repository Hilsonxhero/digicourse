<?php


namespace Payment\Repositories;


use Payment\Models\Settlement;

class SettlementRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Settlement::query();
    }

    public function paginate()
    {
        return $this->query->paginate();
    }

    public function settled()
    {
        $this->query->where("status", Settlement::STATUS_SETTLED);
        return $this;
    }

    public function findById($id)
    {
        return Settlement::query()->findOrFail($id);
    }

    public function store($data)
    {
        return Settlement::query()->create([
            "user_id" => auth()->id(),
            "to" => [
                "name" => $data['name'],
                "cart" => $data['cart_number']
            ],
            "amount" => $data['amount']
        ]);
    }

    public function update($settlement, $request)
    {
        $settlement = $this->findById($settlement);
        return $settlement->update([
            "to" => [
                "name" => $request["to"]['name'],
                "cart" => $request["to"]['cart']
            ],
            "from" => [
                "name" => $request["from"]['name'],
                "cart" => $request["from"]['cart']
            ],
            "status" => $request["status"]

        ]);
    }

    public function getLatestPendingSettlement($user)
    {
        return Settlement::query()
            ->where("user_id", $user)
            ->where("status", Settlement::STATUS_PENDING)
            ->latest()
            ->first();
    }
    public function getLatestSettlement($user)
    {
        return Settlement::query()
            ->where("user_id", $user)
            ->latest()
            ->first();
    }
}
