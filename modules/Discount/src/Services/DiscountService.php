<?php


namespace Discount\Services;


class DiscountService
{
    public static function check($code, $courseId)
    {

    }

    public static function calculateDiscountAmount($total, $percent)
    {
//        return $total * (int)((float)("0." . $percent));
        return $total * $percent / 100;

    }
}
