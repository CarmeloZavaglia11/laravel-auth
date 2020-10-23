@extends('layouts.app')

@section('content')
    
<div class="container d-flex justify-content-center">
    <div class="card m-3" style="width: 20rem;">
        <div class="card-body overflow-auto">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->body}}</p>  
          <div class="card-img mt-3" style="height:5rem;">
            <img src="{{Storage::url($post->img)}}" class="img-fluid" alt="{{$post->title}}">
          </div>        
        </div>
        <a href="{{route('posts.guest.home')}}">Torna Indietro</a> 
    </div>
</div>

@endsection