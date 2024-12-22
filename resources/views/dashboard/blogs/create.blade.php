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
                    <li class="breadcrumb-item active" aria-current="page">Create Blog</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('dashboard.blogs.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <!-- Blog Creation Form -->
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Create New Blog</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.blogs.store') }}" method="POST" id="create" enctype="multipart/form-data">
                        @csrf

                        <!-- Blog Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Blog Title</label>
                            <input class="form-control" type="text" id="title" name="title" placeholder="Enter blog title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Slug -->
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Blog Content</label>
                            <textarea class="form-control" id="content" name="content" placeholder="Enter blog content" rows="5" required>{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Image Upload -->
                        <div class="mb-3">
                            <label for="blog_image" class="form-label">Blog Image</label>
                            <input class="form-control" type="file" id="blog_image" name="blog_image">
                            @error('blog_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Create Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
