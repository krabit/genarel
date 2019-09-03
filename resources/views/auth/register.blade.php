
@extends('frontend.layouts.fashion')

@section('content')

    <div class="login">

        <div class="main-agileits">
            <div class="form-w3agile">
                <h3>Register</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="key">
                        <i class="fa fa-user" aria-hidden="true"></i>

                        <input id="name" type="text"  placeholder="Username" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-envelope" aria-hidden="true"></i>

                        <input id="email" type="text" placeholder="Email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>

                        <input id="password" type="password" placeholder="Password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>

                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>

                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="" name="password_confirmation" required autocomplete="new-password">
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
@endsection
