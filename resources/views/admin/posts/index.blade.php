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
        <div class="card" style="width: 15rem;">
            <div class="card-body">
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
            </div>
        </div>
        @endforeach
    </div>
@endsection