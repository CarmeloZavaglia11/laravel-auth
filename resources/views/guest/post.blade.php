@extends('layouts.app')

@section('content')

    <div class="container d-flex flex-wrap align-items-center flex-column">
        @foreach ($posts as $post)
        <div class="card m-3 card-maded" style="width: 50rem;">
            <div class="card-body overflow-auto">
            <h5 class="card-title text-center text-uppercase text-info">{{$post->title}}</h5>
            <h5 class="card-title">Autore: {{$post->user->name}}</h5>
            <p class="card-text">{{$post->body}}</p>
            <p class="card-text">Tags: @foreach ($post->tags as $tag) {{$tag->name}}@endforeach</p>        
            </div>
            <a class="btn btn-info" href="{{route('posts.guest.show', $post->slug)}}">Dettagli</a>     
        </div>
        @endforeach
    </div>
@endsection