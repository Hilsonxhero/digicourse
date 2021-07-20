<x-app-layout>

    <x-slot name="title">صفحه ثبت نام</x-slot>

    <main>
        <div class="account">
            <form action="{{ route('password.sendVerifyCode') }}" class="form" method="get">
                <a class="account-logo" href="">
                    <img src="{{asset('home/assets/img/weblogo.png')}}" alt="">
                </a>
                <div class="form-content form-account">
                    <input type="email" name="email" class="txt-l txt" placeholder="ایمیل">
                    @error('email')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <br>
                    <button class="btn btn-recoverpass">بازیابی</button>
                </div>
                <div class="form-footer">
                    <a href="{{route('login')}}">صفحه ورود</a>
                </div>
            </form>
        </div>
    </main>

</x-app-layout>
