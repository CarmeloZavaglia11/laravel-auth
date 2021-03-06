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
        <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <img src="{{Storage::url($post->img)}}" class="img-fluid" alt="{{$post->slug}}">
            </div>
            <div class="form-group">
                <label for="img">Immagine</label>
                <input type="file" name="img" accept="image/*">
            </div>
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" name="title"  value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" rows="3">{{$post->body}}</textarea>
            </div>
            <div class="form-group">
                @foreach ($tags as $tag)
                    <label for="tag">{{$tag->name}}</label>
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{($post->tags->contains($tag->id) ? 'checked' : '')}}>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection