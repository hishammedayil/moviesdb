@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>All Movies</h1>
            </div>

            <div class="col-md-4">
                @if(Auth::id())
                <a href="{{ route('movies.create') }}" class="btn btn-primary float-right" style="margin-top:15px;">Add new</a>
                @endif
            </div>
        </div>
        <hr />
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Released</th>
                @if(Auth::id())
                <th>Actions</th>
                @endif
            </tr>
            </thead>

            <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td><a href="{{ route('movies.show', ['movie' => $movie->id]) }}">{{ $movie->id }}</a></td>
                    <td><a href="{{ route('movies.show', ['movie' => $movie->id]) }}">{{ $movie->name }}</a></td>
                    <td><a href="{{ route('movies.show', ['movie' => $movie->id]) }}">{{ $movie->released_on }}</a></td>
                    @if(Auth::id())
                    <td><a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-default">Edit</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $movies->links() }}

    </div>
@endsection

