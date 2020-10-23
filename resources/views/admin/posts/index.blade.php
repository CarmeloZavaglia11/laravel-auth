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

        @if (session('session'))
            <div class="alert alert-success">
                {{ session('session') }}
            </div>
        @endif


    {{-- ERROR--}}
    <div class="container d-flex flex-wrap">
        @foreach ($posts as $post)
        <div class="card m-3" style="width: 20rem;">
            <div class="card-body overflow-auto">
              <h5 class="card-title">{{$post->title}}</h5>
              <p class="card-text">{{$post->body}}</p>
              <div class="d-flex">
                <button type="submit" class="btn btn-primary mr-3"><a href="{{route('posts.edit',$post->id)}}" class="card-link text-white">EDIT</a></button>
                    <form action="{{route('posts.destroy',$post->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
              </div>    
              <div class="card-img mt-3" style="height:5rem;">
                <img src="{{Storage::url($post->img)}}" class="img-fluid" alt="{{$post->title}}">
              </div>          
            </div>
            <a href="{{route('posts.guest.show', $post->slug)}}">Dettagli</a>
        </div>
        @endforeach
        <div class="pagination justify-content-center fixed-bottom">
            {{ $posts->links()}}
        </div>
    </div>
@endsection