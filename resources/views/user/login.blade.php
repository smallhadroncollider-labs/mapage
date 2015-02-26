@extends('app')

@section('content')
<h3>Login</h3>

<form method="post" accept-charset="UTF-8">
    <div class="row">
        <label for="email">Your Email Address</label>
        <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" />
        @if ($errors->has('email'))
        <ul>
            @foreach ($errors->get('email') as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="row">
        <label for="password">Choose a password</label>
        <input type="password" id="password" name="password" placeholder="Password" value="{{ old('password') }}" />
        @if ($errors->has('password'))
        <ul>
            @foreach ($errors->get('password') as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <input class="button-primary" type="submit" value="Login" />
</form>

@endsection
