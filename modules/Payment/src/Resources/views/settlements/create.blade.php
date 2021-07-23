<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">درخواست تسویه جدید</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content">
        <form action="{{route('settlements.store')}}" method="post" class="padding-30 bg-white font-size-14">
            @csrf
            <x-input name="name" type="text" placeholder="نام صاحب حساب" value="{{old('name')}}"></x-input>
            <x-input name="cart_number" type="text" placeholder="شماره کارت"
                     value="{{old('cart_number')}}"></x-input>
            <x-input name="amount" type="text" placeholder="مبلغ به تومان"
                     value="{{auth()->user()->balance}}"></x-input>
            <div class="row no-gutters border-2 margin-bottom-15 text-center ">
                <div class="w-50 padding-20 w-50">موجودی قابل برداشت :‌</div>
                <div class="bg-fafafa padding-20 w-50"> {{number_format(auth()->user()->balance)}} تومان</div>
            </div>
            <div class="row no-gutters border-2 text-center margin-bottom-15">
                <div class="w-50 padding-20">حداکثر زمان واریز :‌</div>
                <div class="w-50 bg-fafafa padding-20">۳ روز</div>
            </div>
            <button type="submit" class="btn btn-webamooz_net">درخواست تسویه</button>
        </form>
    </div>
</x-panel-dashboard>
