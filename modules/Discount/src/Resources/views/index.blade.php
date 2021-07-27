<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">تسویه حساب ها</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content padding-0 discounts">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <div class="table-box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>شناسه</th>
                                <th>کد تخفیف</th>
                                <th>درصد</th>
                                <th>محدودیت زمانی</th>
                                <th>توضیحات</th>
                                <th>استفاده شده</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discounts as $discount)

                                <tr role="row" class="">
                                    <td><a href="">{{$loop->index+1}}</a></td>
                                    <td><a href="">{{$discount->code ? $discount->code : '-'}}</a></td>
                                    <td><a href="">{{$discount->percent}}%</a> @lang($discount->type)</td>
                                    <td>{{$discount->expire_at ?  createFromCarbon($discount->expire_at)  : 'بدون تاریخ انقضا'}}</td>
                                    <td>{{$discount->description}}</td>
                                    <td>{{$discount->uses}} نفر</td>
                                    <td>
                                                      <span>
                                        <form action="{{route('discounts.destroy',$discount->id)}}" method="post">
                                        @csrf
                                            @method('delete')
                                        <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                        </form>
                                    </span>
                                        <a href="{{route('discounts.edit',$discount->id)}}" class="item-edit " title="ویرایش"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include("Discount::create")
        </div>
    </div>
    <x-slot name="style">
        <link rel="stylesheet"
              href="{{asset('panel/assets/vendor/persian-date/css/persian-datepicker-0.4.5.min.css')}}"/>

        <link rel="stylesheet"
              href="{{asset('panel/assets/vendor/select2/css/select2.min.css')}}"/>
    </x-slot>
    <x-slot name="script">
        <script src="{{asset('panel/assets/vendor/select2/js/select2.min.js')}}"></script>

        <script src="{{asset('panel/assets/vendor/persian-date/js/persian-date-0.1.8.min.js')}}"></script>
        <script src="{{asset('panel/assets/vendor/persian-date/js/persian-datepicker-0.4.5.min.js')}}"></script>
        <script>
            $('.custom-select2-js').select2();

            $(document).ready(function () {
                $('#tarikh').persianDatepicker({
                    altField: '#tarikhAlt',
                    altFormat: 'X',
                    format: 'YYYY/MM/DD HH:mm ',
                    observer: true,
                    timePicker: {
                        enabled: true
                    },
                });
            });
        </script>
    </x-slot>
</x-panel-dashboard>
