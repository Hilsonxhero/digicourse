<x-app-layout>
    <x-slot name="title">صفحه ثبت نام</x-slot>
    <main>

        <div class="account">
            <form action="{{ route('register') }}" class="form" method="post">
                @csrf
                <a class="account-logo" href="index.html">
                    <img src="img/weblogo.png" alt="">
                </a>
                <div class="form-content form-account">
                    <input type="text" class="txt" name="name" placeholder="نام و نام خانوادگی">
                    @error('name')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <input type="email" name="email" class="txt txt-l" placeholder="ایمیل">
                    @error('email')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <input type="text" name="phone" class="txt txt-l" placeholder="شماره موبایل">
                    @error('phone')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <input type="password" name="password" class="txt txt-l" placeholder="رمز عبور">
                    @error('password')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <input type="password" name="password_confirmation" class="txt txt-l" placeholder="تکرار رمز عبور">
                    @error('password')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
                    <br>
                    <button class="btn continue-btn">ثبت نام و ادامه</button>

                </div>
                <div class="form-footer">
                    <a href="{{route('login')}}">صفحه ورود</a>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
