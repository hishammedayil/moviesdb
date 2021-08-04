@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $movie->name }}</h1>
        Released on: {{ $movie->released_on }} Rating: {{ $movie->rating }} Ticket rate: {{ $movie->ticket_price }} Country: {{ $movie->country }}
        <hr />
        <img class="media-object img-fluid img-thumbnail rounded" src="{{ $movie->cover_image }}" alt="{{ $movie->name }}">
        <hr />
    </div>
@endsection
