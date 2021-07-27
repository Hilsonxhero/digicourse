<?php

namespace Discount\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Models\Course;
use Course\Repositories\CourseRepo;
use Discount\Http\Requests\DiscountRequest;
use Discount\Models\Discount;
use Discount\Repositories\DiscountRepo;
use Discount\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public $repo;

    public function __construct(DiscountRepo $discountRepo)
    {
        $this->repo = $discountRepo;
    }

    public function index(CourseRepo $courseRepo)
    {
        $discounts = $this->repo->paginate();
        $courses = $courseRepo->getAll(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discount::index", compact('courses', 'discounts'));
    }


    public function create()
    {
        //
    }


    public function store(DiscountRequest $request)
    {

        $this->repo->store($request->all());
        newFeedback();
        return redirect()->route('discounts.index');

    }


    public function show(Discount $discount)
    {
        //
    }

    public function edit($discount, CourseRepo $courseRepo)
    {

        $discount = $this->repo->findById($discount);
        $courses = $courseRepo->getAll(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discount::edit", compact('courses', 'discount'));
    }

    public function update(DiscountRequest $request, $discount)
    {
        $this->repo->update($discount, $request->all());
        newFeedback();
        return redirect()->route('discounts.index');
    }

    public function check($code, Course $course)
    {
        $discount = $this->repo->getValidDiscountByCode($code, $course->id);
        if ($discount) {

            $discountAmount = DiscountService::calculateDiscountAmount($course->getFinalPrice(), $discount->percent);
            $discountPercent = $discount->percent;
            $payableAmount = $course->getFinalPrice() - $discountAmount;
            $response = [
                "status" => "valid",
                "payableAmount" => $payableAmount,
                "discountAmount" => $discountAmount,
                "discountPercent" => $discountPercent
            ];
            return response()->json($response);
        }
        return response()->json([
            "status" => "invalid"
        ])->setStatusCode(422);
    }

    public function destroy($discount)
    {
        $discount = $this->repo->findById($discount);
        $discount->delete();
        newFeedback();
        return back();

    }
}
