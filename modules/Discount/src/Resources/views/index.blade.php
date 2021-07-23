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
                                <th>درصد</th>
                                <th>محدودیت زمانی</th>
                                <th>توضیحات</th>
                                <th>استفاده شده</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">50%</a></td>
                                <td>2 ساعت دیگر</td>
                                <td>مناسبت عید نوروز</td>
                                <td>0 نفر</td>
                                <td>
                                    <a href="" class="item-delete mlg-15"></a>
                                    <a href="edit-discount.html" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد تخفیف جدید</p>
                <form action="" method="post" class="padding-30">
                    <input type="text" placeholder="درسد تخفیف" class="text">
                    <input type="text" placeholder="محدودیت افراد" class="text">
                    <input type="text" placeholder="محدودیت زمانی به ساعت" class="text">
                    <p class="box__title">این تخفیف برای</p>
                    <div class="notificationGroup">
                        <input id="discounts-field-1" class="discounts-field-pn" name="discounts-field" type="radio"/>
                        <label for="discounts-field-1">همه دوره ها</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="discounts-field-2" class="discounts-field-pn" name="discounts-field" type="radio"/>
                        <label for="discounts-field-2">دوره خاص</label>
                    </div>
                    <select name="" class="custom-select-box-js">
                        <option value="0">انتخاب دوره</option>
                        <option value="1">دوره لاراول</option>
                        <option value="2">دوره ری اکت</option>
                        <option value="3">دوره جی اس</option>
                    </select>
                    <input type="text" placeholder="لینک اطلاعات بیشتر" class="text">
                    <input type="text" placeholder="توضیحات" class="text margin-bottom-15">

                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>
</x-panel-dashboard>
