@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Blog Posts</h1>

        @if ($posts->isEmpty())
            <p>No post found yet. <a href="{{ 'admin.posts.create' }}">Create a new once.</a></p>
        @else
            <span>TABLE HERE</span>
        @endif

        @if (session('deleted'))
            <div class="alert alert-success my-4">
                <strong>{{ session('deleted') }}</strong>
                eliminato correttamente
            </div>
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
                    <th>
                        <a class="btn btn-success" href="{{ route('admin.posts.show', $post->slug) }}">Show</a>
                    </th>
                    <th>
                        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                    </th>
                    <th>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input
                                type="submit"
                                value="delete"
                                class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete {{ $post->title }}?')"
                            >
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection