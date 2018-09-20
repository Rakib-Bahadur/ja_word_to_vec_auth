@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-centered">
        {!! Form::open(['url'=>'search', 'method'=>'GET', 'class'=>'form-inline']) !!}
            <div class="form-group">
                {!! Form::text('keyWord',$key,['class'=>'form-control', 'placeholder'=>'Search By Key']) !!}
                {!! Form::submit('Search',['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <h5>
        <strong>Searched on:</strong> {{str_replace('|', ', ', $keys)}}
    </h5>
    <br>
    <div class="row">
        <div class="col-md-8">
            @if (count($posts)>0)
                @foreach ($posts as $post)
                    <div>
                        <a href="posts/{{$post->id}}">
                            <h4>{{$post->title}}</h4>
                        </a>
                        <small>{{$post->post}}</small>
                    </div>
                @endforeach
            @else
                <h3>No Result Found</h3>
            @endif
        </div>
    </div>
</div>
@endsection
