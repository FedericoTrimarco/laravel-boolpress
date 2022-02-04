@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="display-4">Blog Posts</h1>

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
        <table class="table mb-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <th>{{ $post->id }}</th>
                    <th>{{ $post->title }}</th>
                    <th>
                        @if ($post->category)
                            <a href="{{ route('admin.category', $post->category->id) }}">{{ $post->category->name }}</a>
                        @else
                            Uncategorized
                        @endif
                    </th>
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
    </section>
    
    {{-- tags --}}
    <section class="container">
        <h2 class="mb-4 display-4">Post by tag</h2>
        <div class="d-flex justify-content-between ">
            @foreach ($tags as $tag)

                <div class="card p-4">
                    <h3>{{ $tag->name }}</h3>
        
                    @if ($tag->posts->isEmpty())
                        <p>No post found.</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($tag->posts as $post)
                                <li>
                                    <a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            @endforeach

        </div>
    </section>
@endsection