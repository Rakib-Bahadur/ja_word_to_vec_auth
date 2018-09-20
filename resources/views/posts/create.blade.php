@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Create Post</h3>
        <div class="col-md-6">
            {!! Form::open(['url'=>'posts','method'=>'POST', 'class'=>'form-horizontal']) !!}
                <div class="form-group">
                    <label for="title">Title</label>
                    {!! Form::text('title','',['class'=>'form-control', 'id'=>'title']) !!}
                </div>
                <div class="form-group">
                    <label for="post">Post</label>
                    {!! Form::textarea('post','',['class'=>'form-control', 'id'=>'post']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Post', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection