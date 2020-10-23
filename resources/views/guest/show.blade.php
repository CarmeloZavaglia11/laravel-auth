@extends('layouts.app')

@section('content')
    
<div class="container d-flex justify-content-center">
    <div class="card m-3 card-show">
      <div class="card-img mt-3">
        <img src="{{Storage::url($post->img)}}" class="img-fluid" alt="{{$post->title}}">
      </div>  
        <div class="card-body overflow-auto">
          <h5 class="card-title text-center text-uppercase text-info">{{$post->title}}</h5>
          <h5 class="card-title">Autore: {{$post->user->name}}</h5>
          <p class="card-text">{{$post->body}}</p>                 
        </div>

        <a class="btn btn-info" href="{{route('posts.index')}}">I tuoi Post</a>
        <a class="btn btn-info" href="{{route('posts.guest.home')}}">Tutti i post</a>

      
    </div>
</div>

@endsection