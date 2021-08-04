@extends('layouts.app')

@section('head-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
@endsection

@section('content')
    <div class="container">
        <h1>Add Movie</h1>
        <hr />
        @if(!isset($movie->id))
        <form method="post" action="{{ route('movies.store') }}" enctype="multipart/form-data">
        @else
        <form action="{{ route('movies.update', [$movie->id]) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
        @endif
            {{ csrf_field() }}
            <div class="form-group">
                <label for="movie_name">Name</label>
                <input type="text" class="form-control" id="movie_name" name="name" placeholder="Name" value="{{ !empty(old('name')) ? old('name') : $movie->name }}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_description">Description</label>
                <textarea class="form-control" rows="8" id="movie_description" name="description" placeholder="Description...">{{ !empty(old('description')) ? old('description') : $movie->description }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_genres">Genre</label>
                <select id="movie_genres" multiple="multiple" name="genres[]" class="form-control">
                    @foreach($genres as $genre)
                        <option value="{{ $genre['id'] }}" {{ ((is_array(old('genres')) && in_array($genre['id'], old('genres'))) || (is_array($movie->genreIds) && in_array($genre['id'], $movie->genreIds))) ? 'selected' : '' }}>{{ $genre['name'] }}</option>
                    @endforeach
                </select>
                @error('genres')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_released_on">Released on</label>
                <input type="date" class="form-control" id="movie_released_on" name="released_on" placeholder="Name" value="{{ !empty(old('released_on')) ? old('released_on') : $movie->released_on }}">
                @error('released_on')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_ticket_price">Ticket price</label>
                <input type="number" step="0.01" class="form-control" id="movie_ticket_price" name="ticket_price" placeholder="Ticket price" value="{{ !empty(old('ticket_price')) ? old('ticket_price') : $movie->ticket_price }}">
                @error('ticket_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_country">Country</label>
                <input type="text" class="form-control" id="movie_country" name="country" placeholder="Country" value="{{ !empty(old('country')) ? old('country') : $movie->country }}">
                @error('country')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_cover_image">Cover image</label>
                <input type="file" class="form-control-file" id="movie_cover_image" name="cover_image" placeholder="Cover image" value="">
                @error('cover_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if(isset($movie->id))
                <img src="{{ $movie->cover_image }}" alt="image..." class="img-fluid media-body img-thumbnail rounded">
                @endif
            </div>
            <div class="form-group">
                <label for="movie_rating" class="mb-0">Rating</label>
                <div class="rating mt-n2">
                    <input type="radio" name="rating" value="5" id="5" {{ old('rating') == 5 || (empty(old('rating')) && $movie->rating == 5) ? 'checked' : '' }}><label for="5">☆</label>
                    <input type="radio" name="rating" value="4" id="4" {{ old('rating') == 4 || (empty(old('rating')) && $movie->rating == 4) ? 'checked' : '' }}><label for="4">☆</label>
                    <input type="radio" name="rating" value="3" id="3" {{ old('rating') == 3 || (empty(old('rating')) && $movie->rating == 3) ? 'checked' : '' }}><label for="3">☆</label>
                    <input type="radio" name="rating" value="2" id="2" {{ old('rating') == 2 || (empty(old('rating')) && $movie->rating == 2) ? 'checked' : '' }}><label for="2">☆</label>
                    <input type="radio" name="rating" value="1" id="1" {{ old('rating') == 1 || (empty(old('rating')) && $movie->rating == 1) ? 'checked' : '' }}><label for="1">☆</label>
                </div>
                @error('rating')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Save Movie</button>
        </form>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/movie.js') }}"></script>
@endsection
