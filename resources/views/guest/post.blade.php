@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap">
        @foreach ($posts as $post)
        <div class="card m-3" style="width: 20rem;">
            <div class="card-body overflow-auto">
            <h5 class="card-title">{{$post->title}}</h5>
            <h5 class="card-title">{{$post->user->name}}</h5>
            <p class="card-text">{{$post->body}}</p>
            <div class="card-img mt-3" style="height:5rem;">
                <img src="{{Storage::url($post->img)}}" class="img-fluid" alt="{{$post->title}}">
            </div>          
            </div>
            <a href="{{route('posts.guest.show', $post->slug)}}">Dettagli</a>     
        </div>
        @endforeach
    </div>
@endsection