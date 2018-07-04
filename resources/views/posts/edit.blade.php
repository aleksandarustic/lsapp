@extends('layouts.app')

@section('content')
    <h1>Edit posts</h1>

    /* Prosledivanje parametara u formi ['PostsController@update',$post->id] */
    {!! Form::open(['action' => ['PostsController@update',$post->id],'method' => 'post']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class'=> 'form-control','placeholder' => 'title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body',$post->title,['id'=> 'article-ckeditor','class'=> 'form-control','placeholder' => 'Body text'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection