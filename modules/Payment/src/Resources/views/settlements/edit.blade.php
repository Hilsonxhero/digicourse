<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">تسویه حساب ها</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content">
        <form action="{{route('settlements.update',$settlement->id)}}" method="post"
              class="padding-30 bg-white font-size-14">
            @csrf
            @method('put')
            <x-input name="from[name]" type="text" placeholder="نام صاحب حساب فرستنده"
                     value='{{is_array($settlement->from) && array_key_exists("name",$settlement->from) ? $settlement->to["name"] : ""}}'></x-input>
            <x-input name="from[cart]" type="text" placeholder="شماره کارت فرستنده"
                     value='{{is_array($settlement->from) && array_key_exists("cart",$settlement->from) ? $settlement->to["cart"] : ""}}'></x-input>

            <x-input name="to[name]" type="text" placeholder="نام صاحب حساب"
                     value='{{is_array($settlement->to) && array_key_exists("name",$settlement->to) ? $settlement->to["name"] : ""}}'></x-input>
            <x-input name="to[cart]" type="text" placeholder="شماره کارت"
                     value='{{is_array($settlement->to) && array_key_exists("cart",$settlement->to) ? $settlement->to["cart"] : ""}}'></x-input>

            <x-select name="status" class="custom-select-box-js">
                <option value="">انتخاب مدرس دوره</option>
                @foreach(\Payment\Models\Settlement::$statuses as $status)
                    <option value="{{$status}}"
                            @if($settlement->status == $status) selected @endif>@lang($status)</option>
                @endforeach
            </x-select>

            <x-input name="amount" type="text" placeholder="مبلغ به تومان"
                     value="{{$settlement->amount}}"></x-input>
            <div class="row no-gutters border-2 margin-bottom-15 text-center ">
                <div class="w-50 padding-20 w-50">موجودی قابل برداشت :‌</div>
                <div class="bg-fafafa padding-20 w-50"> {{number_format($settlement->user->balance)}} تومان</div>
            </div>
            <button type="submit" class="btn btn-webamooz_net">ویرایش درخواست تسویه</button>
        </form>
    </div>

</x-panel-dashboard>
