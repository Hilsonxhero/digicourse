<?php

namespace Discount\Models;

use Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Payment\Models\Payment;

class Discount extends Model
{
    const TYPE_ALL = "all";
    const TYPE_SPECIAL = "special";
    public static $types =
        [
            self::TYPE_ALL,
            self::TYPE_SPECIAL
        ];
    protected $guarded = [];
    protected $casts = [
        "expire_at" => "datetime"
    ];
    use HasFactory;


    public function courses()
    {
        return $this->morphedByMany(Course::class, "discountable");
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class,'discount_payment');
    }

}
