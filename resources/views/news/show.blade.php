@extends('layouts.app')

@section('content')

<h2>{{ $news->name }}</h2>

<div>{{ $news->content }}</div>

<hr>

<post-component :post_id="{{ $news->id }}"></post-component>

<hr>

@endsection