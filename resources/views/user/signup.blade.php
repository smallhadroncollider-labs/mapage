@extends('app')

@section('content')
<h3>Sign Up</h3>

<form method="post" accept-charset="UTF-8">
    <div class="row">
        <label for="name">Your Display Name</label>
        <input type="text" id="name" name="name" placeholder="Display Name" value="{{ old('name') }}" />
        @if ($errors->has('name'))
        <ul>
            @foreach ($errors->get('name') as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>

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
        <input type="password" name="password_confirmation" placeholder="Confirm" vlaue="{{ old('password_confirmation') }}" />
        @if ($errors->has('password') || $errors->has('password_confirmation'))
        <ul>
            @foreach (array_merge($errors->get('password'), $errors->get('password_confirmation')) as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <input class="button-primary" type="submit" value="Sign Up" />
</form>

@endsection
