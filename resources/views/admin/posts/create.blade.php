@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Create a new post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="form-label">Title*</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="form-label">Content*</label>
                <textarea name="content" id="content" rows="5" class="form-control">{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- categories --}}
            <div class="mb-4">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Uncategorized</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @if ($category->id == old('category_id')) selected @endif
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- tags --}}
            <div class="mb-4">
                <h4>Tags</h4>
                @foreach ($tags as $tag)
                    <span class="mr-3">
                        <input
                            type="checkbox"
                            name="tags[]"
                            id="tag{{ $loop->iteration }}"
                            value="{{ $tag->id }}"
                            @if (in_array($tag->id, old('tags', []))) checked @endif
                        >
                        
                        <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    </span>
                @endforeach
                @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- post cover image --}}
            <div class="mb-5">
                <label for="cover" class="form-label">Post Image</label>
                <input type="file" class="form-control-file" name="cover" id="cover">
                @error('cover')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection