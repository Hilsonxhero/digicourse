<?php

use Morilog\Jalali\Jalalian;

function newFeedback($title = "موفقیت آمیز", $message = "عملیات موفقیت آمیز بود", $status = "success")
{
    session()->flash('feedback', ['title' => $title, 'message' => $message, 'status' => $status]);
}

function dateFromJalali($data, $format = "Y-m-d")
{
    return $data ? Jalalian::fromFormat($format, $data)->toCarbon() : null;
}

function getJalalieFromFormat($data, $format = "Y-m-d")
{
    return Jalalian::fromCarbon(\Carbon\Carbon::createFromFormat($format, $data))->format($format);
}

function createFromCarbon(\Carbon\Carbon $carbon)
{
    return Jalalian::fromCarbon($carbon);
}
