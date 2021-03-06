@extends('layouts.app')

@section('content')
    {{-- ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    {{-- ERROR--}}
    <div class="container">
        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" name="title" placeholder="inserisci un titolo..">
            </div>
            <div class="form-group">
                <label for="img">Immagine</label>
                <input type="file" name="img" accept="image/*">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" placeholder="inserisci un testo" rows="3"></textarea>
            </div>
                <div class="form-group">
                    @foreach ($tags as $tag)
                        <label for="tag">{{$tag->name}}</label>
                        <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                    @endforeach
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection