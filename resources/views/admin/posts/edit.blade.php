@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Edit {{ $post->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="title" class="form-label">Title*</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="form-label">Content*</label>
                <textarea name="content" id="content" rows="5" class="form-control">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection