<x-app-layout>
    <x-slot name="title">فعال سازی حساب کاربری</x-slot>
    <main>

        <div class="account act">
            <form action="{{ route('password.checkVerifyCode') }}" class="form" method="post">
                @csrf
                <input type="hidden" name="email" value="{{request()->email}}">
                <a class="account-logo" href="index.html">
                    <img src="img/weblogo.png" alt="">
                </a>
                <div class="card-header">
                    <p class="activation-code-title">کد فرستاده شده به ایمیل <span>{{request()->email}}</span>
                        را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
                    </p>
                </div>
                <div class="form-content form-content1">
                    <input class="activation-code-input" name="code" placeholder="فعال سازی">

                    @error('code')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror


                    <br>
                    <button class="btn i-t">تایید</button>
                    <a id="resend-code-btn" href="#">ارسال مجدد کد فعال سازی</a>

                </div>
                <div class="form-footer">
                    <a  href="{{route('register')}}">صفحه ثبت نام</a>
                </div>
            </form>
            <form  id="resend-code" action="{{ route('verification.resend') }}" method="post">
                @csrf
            </form>
        </div>
    </main>

</x-app-layout>
