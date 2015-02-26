@extends('app')

@section('content')

<p class="hidden" id="js__login-message">You must be <a href="/login">logged in</a> to leave a message. You may need to <a href="/signup">create an account</a></p>

<p id="js__loading" class="throb">Loading...</p>

<form class="hidden" id="js__message">
    <div>
        <textarea id="js__message-text" placeholder="Leave a message"></textarea>
    </div>

    <button id="js__submit">Submit</button>
</form>

<div id="js__message-list"></div>

<script data-main="/js/load.js" src="/vendor/requirejs/require.js"></script>

@endsection
