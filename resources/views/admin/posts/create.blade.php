@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('posts.store')}}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" name="title" placeholder="inserisci un titolo..">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" placeholder="inserisci un testo" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection