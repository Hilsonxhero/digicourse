<?php

namespace Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Payment\Repositories\PaymentRepo;

class DashboardController extends Controller
{
    public function index(PaymentRepo $paymentRepo)
    {
        $totalSales = $paymentRepo->getUserTotalSuccessAmount(auth()->user()->id);
        $totalBenefit = $paymentRepo->getUserTotalBenefit(auth()->user()->id);
        $totalSiteShare = $paymentRepo->getUserTotalSiteShare(auth()->user()->id);
        $todayBenefit = $paymentRepo->getUserTotalBenefitByDay(auth()->user()->id, now());
        $last30DaysBenefit = $paymentRepo->getUserTotalBenefitByPeriod(auth()->user()->id, now(), now()->addDays(-30));

        $todaySuccessPaymentsTotal = $paymentRepo->getUserTotalSellByDay(auth()->user()->id, now());
        $todaySuccessPaymentsCount = $paymentRepo->getUserSellCountByDay(auth()->user()->id, now());

        $payments = $paymentRepo->paymentsBySellerId(auth()->id())->paginate();

        $last30DaysTotal = $paymentRepo->getDaysTotal(-30);
        $last30DaysSellerBenefit = $paymentRepo->getLastNDaysSellerBenefit(-30);
        $totalSell = $paymentRepo->getDaysTotal();

        $dates = collect();
        foreach (range(-30, 0) as $i) {
            $dates->put(now()->addDays($i)->format("Y-m-d"), 0);
        }

        $summery = $paymentRepo->getDailySummery($dates,auth()->id());

        return view('Dashboard::index', compact(
            'payments',
            'totalSales',
            'totalBenefit',
            'totalSiteShare', 'todayBenefit',
            'last30DaysBenefit', 'todaySuccessPaymentsTotal',
            'todaySuccessPaymentsCount',
            'last30DaysTotal',
            'last30DaysSellerBenefit',
            'totalSell',
            'dates',
            'summery'
        ));
    }
}
