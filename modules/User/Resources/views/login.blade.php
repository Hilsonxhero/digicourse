<x-app-layout>
    <x-slot name="title">صفحه ورود</x-slot>
    <main>
        <div class="account">
            <form action="{{ route('login') }}" class="form" method="post">
                @csrf
                <a class="account-logo" href="index.html">
                    <img src="img/weblogo.png" alt="">
                </a>
                <div class="form-content form-account">

                    <input type="text" name="email" class="txt-l txt" placeholder="ایمیل یا شماره موبایل">

                    @error('email')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror


                    <input type="password" name="password" class="txt-l txt" placeholder="رمز عبور">
                    @error('password')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <br>
                    <button class="btn btn--login">ورود</button>
                    <label class="ui-checkbox">
                        مرا بخاطر داشته باش
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                    </label>
                    <div class="recover-password">
                        <a href="{{ route('password.request') }}">بازیابی رمز عبور</a>
                    </div>
                </div>
                <div class="form-footer">
                    <a href="{{route('register')}}">صفحه ثبت نام</a>
                </div>
            </form>
        </div>
    </main>

</x-app-layout>
