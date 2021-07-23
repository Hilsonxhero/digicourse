<?php

namespace Discount\Http\Controllers;

use App\Http\Controllers\Controller;
use Discount\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function index()
    {
     return view("Discount::index");
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Discount $discount)
    {
        //
    }

    public function edit(Discount $discount)
    {
        //
    }

    public function update(Request $request, Discount $discount)
    {
        //
    }

    public function destroy(Discount $discount)
    {
        //
    }
}
