@extends('app')

@section('content')
<form id="js__message">
    <div>
        <textarea id="js__message-text" placeholder="Leave a message"></textarea>
    </div>

    <button>Submit</button>
</form>

<ul id="js__message-list"></ul>

<script data-main="/js/load.js" src="/vendor/requirejs/require.js"></script>

@endsection
