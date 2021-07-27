<?php


namespace Discount\Repositories;


use Discount\Models\Discount;
use Morilog\Jalali\Jalalian;

class DiscountRepo
{

    public function findById($id)
    {
        return Discount::query()->find($id);
    }

    public function paginate()
    {
        return Discount::query()->latest()->paginate();
    }

    public function store($data)
    {
        $discount = Discount::query()->create([
            "user_id" => auth()->id(),
            "code" => $data["code"],
            "percent" => $data["percent"],
            "usage_limitation" => $data["usage_limitation"],
            "expire_at" => $data["expire_at"] ? Jalalian::fromFormat("Y/m/d H:i", $data["expire_at"])->toCarbon() : null,
            "link" => $data["link"],
            "type" => $data["type"],
            "description" => $data["description"],
            "uses" => 0,
        ]);
        if ($discount->type == Discount::TYPE_SPECIAL) {
            $discount->courses()->sync($data["courses"]);
        }
    }

    public function update($id, $data)
    {
        Discount::query()->where("id", $id)->update([
            "code" => $data["code"],
            "percent" => $data["percent"],
            "usage_limitation" => $data["usage_limitation"],
            "expire_at" => $data["expire_at"] ? Jalalian::fromFormat("Y/m/d H:i", $data["expire_at"])->toCarbon() : null,
            "link" => $data["link"],
            "type" => $data["type"],
            "description" => $data["description"],
        ]);
        $discount = $this->findById($id);
        if ($discount->type == Discount::TYPE_SPECIAL) {
            $discount->courses()->sync($data["courses"]);
        } else {
            $discount->courses()->sync([]);
        }
    }

    public function getValidDiscountByCode($code, $courseId)
    {
        return Discount::query()
            ->where("code", $code)
            ->where(function ($query) use ($courseId) {

                return $query->whereHas("courses", function ($query) use ($courseId) {
                    return $query->where("id", $courseId);
                })->orWhereDoesntHave("courses");
            })
            ->first();
    }


    public function getValidDiscountQuery($type = Discount::TYPE_ALL, $id = null)
    {
        $query = Discount::query()
            ->where("expire_at", ">", now())
            ->where("type", $type)
            ->whereNull("code");
        if ($id) {
            $query->whereHas("courses", function ($query) use ($id) {
                $query->where("id", $id);
            });
        }

        $query->where(function ($query) {
            $query->where("usage_limitation", ">", "0")->orWhereNull("usage_limitation");
        })->orderBy("percent", "desc");

        return $query;
    }

    public function getGlobalBiggerDiscount()
    {
        return $this->getValidDiscountQuery()->first();
    }

    public function getCourseBiggerDiscount($id)
    {
        return $this->getValidDiscountQuery(Discount::TYPE_SPECIAL, $id)->first();
    }


}
