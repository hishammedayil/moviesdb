@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $movie->name }}</h1>
        Released on: {{ $movie->released_on }} Rating: {{ $movie->rating }} Ticket rate: {{ $movie->ticket_price }} Country: {{ $movie->country }}
        <hr />
        <img class="media-object img-fluid img-thumbnail rounded" src="{{ $movie->cover_image }}" alt="{{ $movie->name }}">
        <hr />

        <h3>Comments:</h3>
        @if(Auth::check())
            <div style="margin-bottom:50px;">
                <textarea id="comment-text" class="form-control" rows="3" name="body" placeholder="Leave a comment"></textarea>
                <button id="post-comment" class="btn btn-success" style="margin-top:10px">Save Comment</button>
            </div>
        @else
            <div>Please login to post a comment.</div>
        @endif

        <div id="comments-container">
            <template id="comment-template">
            <div class="media" style="margin-top:20px;">
                <div class="media-body comment-body">
                    <h4 class="media-heading comment-heading"></h4>
                    <p class="comment-content"></p>
                    <span style="color: #aaa;" class="comment-time"></span>
                </div>
            </div>
            </template>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/CommentManager.js') }}"></script>
    <script>
        const commentManager = new CommentManager(
            {!! $movie->toJson() !!},
            '{!! route('comments.index', [$movie->id]) !!}',
            '{!! route('comments.store', [$movie->id]) !!}',
            axios
        );

        commentManager.init();
    </script>
@endsection
