@extends('dashboard.layout')

@section('content')
<div class="container">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Breadcrumb Navigation -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Blogs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('dashboard.blogs.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <!-- Blog Edit Form -->
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Edit Blog</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Blog Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input class="form-control" type="text" id="title" name="title" placeholder="Enter blog title" value="{{ old('title', $blog->title) }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Slug -->
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter slug" value="{{ old('slug', $blog->slug) }}" required>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" placeholder="Enter blog content" rows="4" required>{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Image Upload -->
                       <!-- Blog Image (Optional) -->
                       <div class="mb-3">
                        <label for="blog_image" class="form-label">Blog Image</label>
                        <input class="form-control" type="file" id="blog_image" name="blog_image">
                        @error('blog_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                        <!-- Display current image -->
                        @if($blog->image )
                            <div class="mt-2">
                                <label>Current Image:</label>
                                <img src="{{ asset('public/'.$blog->image) }}" alt="Blog Image" class="img-thumbnail" width="100">
                            </div>
                        @else
                            <div class="mt-2">
                                <label>Current Image:</label>
                                <img src="{{ asset('public/blogs/default_image.jpg') }}" alt="Default Image" class="img-thumbnail" width="100">
                            </div>
                        @endif
                    </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
