<?php

function newFeedback($title= "موفقیت آمیز", $message="عملیات موفقیت آمیز بود", $status="success")
{
    session()->flash('feedback', ['title' => $title, 'message' => $message,'status' => $status]);
}
