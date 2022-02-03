@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ $category->name }}</h1>

        @foreach ($category->post as $post)
            <article>
                <h2>{{ $post->title }}</h2>
                <a href="{{ route('admin.posts.show', $post->slug) }}">Show</a>
                <a href="">Edit</a>
            </article>
        @endforeach
    </div>
@endsection