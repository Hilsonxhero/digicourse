<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="index.html" title="پیشخوان">پیشخوان</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content">
        <div class="row no-gutters border-radius-3 font-size-13">
            <div class="col-12 bg-white padding-30 margin-bottom-20">
                {{$user->name}}
            </div>
        </div>

        <div class="row no-gutters border-2 margin-bottom-15 text-center ">
            <div class="w-50 padding-20">نام :</div>
            <div class="bg-fafafa padding-20 w-50">{{$user->name}}</div>

            <div class="w-50 padding-20">ایمیل :</div>
            <div class="bg-fafafa padding-20 w-50">{{$user->email}}</div>

            <div class="w-50 padding-20">شماره موبایل :</div>
            <div class="bg-fafafa padding-20 w-50">{{$user->phone}}</div>

            <div class="w-50 padding-20">موجودی حساب :</div>
            <div class="bg-fafafa padding-20 w-50">{{number_format($user->balance)}} تومان</div>

            <div class="w-50 padding-20">وضعیت حساب :</div>
            <div class="bg-fafafa padding-20 w-50">{!! $user->isVerify() !!}</div>
        </div>
        <div class="row bg-white no-gutters font-size-13 margin-bottom-15">
            <div class="title__row">
                <p>پرداخت های اخیر شما</p>
                <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه تراکنش ها</a>
            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه پرداخت</th>
                        <th>محصول</th>
                        <th>مبلغ پرداخت</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->payments as $payment)
                        <tr role="row">
                            <td><a href=""> {{$loop->index +1}}</a></td>
                            <td><a href=""> {{$payment->paymentable->title}}</a></td>
                            <td><a href=""> {{$payment->amount}}</a></td>
                            <td><a href="">@lang($payment->status)</a></td>
                            <td><a href="">{{createFromCarbon($payment->created_at)}}</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row bg-white no-gutters font-size-13 margin-bottom-15">
            <div class="title__row">
                <p>دوره های در حال تدریس</p>
                <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه دوره ها</a>
            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه </th>
                        <th>عنوان دوره</th>
                        <th>وضعیت</th>
                        <th>تاریخ ایجاد</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->courses as $course)
                        <tr role="row">
                            <td><a href=""> {{$loop->index +1}}</a></td>
                            <td><a href=""> {{$course->title}}</a></td>
                            <td><a href="">@lang($course->status)</a></td>
                            <td><a href=""> {{createFromCarbon($course->created_at)}}</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row bg-white no-gutters font-size-13 margin-bottom-15">
            <div class="title__row">
                <p>دوره های خریداری شده</p>
            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه </th>
                        <th>عنوان دوره</th>
                        <th>مبلغ پرداخت شده</th>
                        <th>تاریخ </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->purchases as $purchase)
                        <tr role="row">
                            <td><a href=""> {{$loop->index +1}}</a></td>
                            <td><a href=""> {{$purchase->title}}</a></td>
                            <td><a href="">{{$purchase->payment()->amount}}</a></td>
                            <td><a href=""> {{createFromCarbon($purchase->created_at)}}</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row bg-white no-gutters font-size-13 margin-bottom-15">
            <div class="title__row">
                <p>درخواست های تسویه</p>
            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه </th>
                        <th>مبلغ پرداخت شده</th>
                        <th>وضعیت </th>
                        <th>تاریخ </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->settlements as $settlement)
                        <tr role="row">
                            <td><a href=""> {{$loop->index +1}}</a></td>
                            <td><a href=""> {{number_format($settlement->amount)}}</a></td>
                            <td><a href="">{!! $settlement->status() !!}</a></td>
                            <td><a href=""> {{createFromCarbon($purchase->created_at)}}</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-panel-dashboard>
