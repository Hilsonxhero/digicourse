<?php

namespace Payment\Models;

use Discount\Models\Discount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Payment extends Model
{
    protected $guarded = [];

    const STATUS_PENDING = 'pending';
    const STATUS_CANCELED = 'canceled';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';
    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_CANCELED,
        self::STATUS_SUCCESS,
        self::STATUS_FAIL
    ];
    use HasFactory;

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, "buyer_id");
    }

    public function seller()
    {
        return $this->belongsTo(User::class, "seller_id");
    }

    public function getCreateAtInJalali()
    {
        return verta($this->created_at)->format('%d %B %Y');
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'discount_payment')->withTimestamps();
    }

    public function status()
    {
        switch ($this->status) {
            case Payment::STATUS_PENDING:
                return '<span class="text-warning">در حال انتظار</span>';
                break;
            case Payment::STATUS_SUCCESS:
                return '<span class="text-success">پرداخت موفق</span>';
                break;
            case Payment::STATUS_FAIL:
                return '<span class="text-error"> پرداخت ناموفق</span>';
                break;
            case Payment::STATUS_CANCELED:
                return '<span class="text-error">لغو شده</span>';
                break;
        }
    }

}
