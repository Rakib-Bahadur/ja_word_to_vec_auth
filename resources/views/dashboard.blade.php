@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (count($posts)>0)
                <h3>Your Post</h3>
                @foreach ($posts as $post)
                    <div class="panel panel-default">
                        <a href="posts/{{$post->id}}">
                            <div class="panel-heading">{{$post->title}}</div>
                        </a>
                        <div class="panel-body">{{$post->post}}</div>
                    </div>
                @endforeach
            @else
                <h3>You have no post</h3>
            @endif
        </div>
    </div>
</div>
@endsection
