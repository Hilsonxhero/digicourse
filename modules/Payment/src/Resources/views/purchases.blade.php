<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">خرید های من</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content">
        <div class="table__box">
            <table  class="table">
                <thead>
                <tr class="title-row">
                    <th>عنوان دوره</th>
                    <th>تاریخ پرداخت</th>
                    <th>مقدار پرداختی</th>
                    <th>وضعیت پرداخت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td><a href="{{$payment->paymentable->path()}}" target="_blank">{{$payment->paymentable->title}}</a> </td>
                        <td>{{createFromCarbon($payment->created_at)}}</td>
                        <td>{{number_format($payment->paymentable->price)}} تومان</td>
                        <td class="successful">{!! $payment->status() !!}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="pagination">
            محل قرار گیری صفحه بندی

        </div>
    </div>
</x-panel-dashboard>
