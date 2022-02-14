@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ $post->title }}</h1>

        <div class="mb-5">
            <span class="mb-3">
                <strong>Category</strong>
                @if ($post->category) {{ $post->category->name }} @else Uncategorized @endif
            </span>
            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
            <a class="btn btn-warning" href="{{ route('admin.posts.index') }}">Back to archive</a>
        </div>

        <div class="row">
            <div class="{{ $post->cover ? 'col-6' : 'col-12' }}">
                {!! $post->content !!}
            </div>
            @if ($post->cover)
                <div class="col-6">
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}" class="img-fluid">
                </div>
            @endif
        </div>

        @if (!$post->tags->isEmpty())
            <h4 class="mt-3">Tags</h4>

            @foreach ($post->tags as $tag)
                <span class="badge badge-primary">{{ $tag->name }}</span>
            @endforeach
        @else
            <p>No tags found.</p>
        @endif
    </div>
@endsection