@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Blog Posts</h1>

        @if ($posts->isEmpty())
            <p>No post found yet. <a href="{{ 'admin.posts.create' }}">Create a new once.</a></p>
        @else
            TABLE HERE
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <th>{{ $post->id }}</th>
                    <th>{{ $post->title }}</th>
                    <th>SHOW</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection