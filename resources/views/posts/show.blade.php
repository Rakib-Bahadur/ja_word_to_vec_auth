@extends('layouts.app')

@section('content')
<div class="container">
        @if(!Auth::guest())
            <a href="/home">Go Back</a>
        @else
            <a href={{ url()->previous() }}>Go Back</a>
        @endif
        <h1>{{$post->title}}</h1>
        <br><br>
        <div>
            {{$post->post}}
        </div>
        <hr>
        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
        <hr>
        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            @endif
        @endif
</div>
@endsection