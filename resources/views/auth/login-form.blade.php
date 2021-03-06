<form action="{{ route('login') }}" method="POST" class="login-form" id="login-form">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-sm-6 col-md-12 login-wrapper" style="margin-bottom: 19px;">
                <input type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ old('email') }}" placeholder="Введите почту" required autofocus>
                @if ($errors->has('email'))
                    <span class="error">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                @endif
            </div>
            <div class="position-relative col-12 col-sm-6 col-md-12" style="padding-right: 29px; padding-left: 0; margin-bottom: 19px;">
                <input type="password" name="password" id="password"
                       class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value=""
                       placeholder="Введите пароль" required style="    border-top-right-radius: 0;
    border-bottom-right-radius: 0;">
                @if ($errors->has('password'))
                    <span class="error">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                @endif
                <button type="submit" class="btn-login btn-blue">Ok</button>
            </div>
        </div>
    </div>

    <div class="remember">
        <input type="checkbox" name="remember" value="1" id="remember_me" class="margin-right-10 margin-top-10" /> <span>Remember me</span>
    </div>
</form>
