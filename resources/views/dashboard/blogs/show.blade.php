@extends('dashboard.layout')

@section('content')
<div class="container">
    <!-- Breadcrumb Navigation -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Blogs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Blog</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <!-- Back Button -->
            <a href="{{ route('dashboard.blogs.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Blog View Details -->
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">View Blog Details</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <!-- Blog Image Display -->
                    <div class="mb-3 text-center">
                        <td>
                            @if($blog->image)
                                <!-- Display the blog image if it exists -->
                                <img src="{{ asset('public/'.$blog->image) }}" alt="Blog Image" class="img-fluid" width="200">
                            @else
                                <!-- Display the default image if no image exists -->
                                <img src="{{ asset('public/blogs/default_image.jpg') }}" alt="Default Image" class="img-fluid" width="200">
                            @endif
                        </td>
                    </div>

                    <!-- Blog Details Table -->
                    <table class="table table-bordered">
                        <tr>
                            <th>Title</th>
                            <td>{{ $blog->title }}</td>
                        </tr>
                        <tr>
                            <th>Content</th>
                            <td>{{ $blog->content }}</td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td>{{ $blog->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $blog->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $blog->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    </table>

                    <!-- Edit and Delete Actions -->
                    <div class="mt-4">
                        <a href="{{ route('dashboard.blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                        
                        <form action="{{ route('dashboard.blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog View Details -->

</div>
@endsection
