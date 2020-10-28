@extends('layouts.app')

@section('content')

    @guest
        <p class="lead text-center display-4">Benvenuto nel mio Blog!</p>
    @else
        <p class="lead text-center display-4">Benvenuto nel mio Blog {{ Auth::user()->name }}!</p>
    @endguest

@endsection

