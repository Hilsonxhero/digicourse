<x-app-layout>
    <x-slot name="title">صفحه بازیابی رمز عبور</x-slot>
    <main>
        <div class="account">
            <form action="{{ route('password.update') }}" class="form" method="post">
                @csrf


                <a class="account-logo" href="index.html">
                    <img src="img/weblogo.png" alt="">
                </a>
                <div class="form-content form-account">

                    <input type="password" name="password" class="txt-l txt" placeholder="رمز عبور جدید">
                    @error('password')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror

                    <input type="password" name="password_confirmation" class="txt txt-l" placeholder="تکرار رمز عبور جدید">
                    <br>

                    <button class="btn btn--login">بازیابی</button>


                </div>
                <div class="form-footer">
                    <a href="{{route('register')}}">صفحه ثبت نام</a>
                </div>
            </form>
        </div>
    </main>

</x-app-layout>
