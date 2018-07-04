@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <small>
       Writen on {{$post->created_at}}
    </small>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn-default btn">Edit</a>

    {!! Form::open(['action' => ['PostsController@destroy',$post->id] ,'method' => 'POST','class' => 'pull-right' ])  !!}
        {!! Form::hidden('_method','DELETE') !!}
        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection
