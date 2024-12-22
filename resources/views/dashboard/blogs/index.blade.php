@extends('dashboard.layout')

@section('content')
<div class="container">

    <div class="card-body">

        <!-- Display validation errors -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Success or error message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Blogs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                @can('create_blog')
                <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary">Create Blog</a>
                @endcan
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Title and Instructions for Import -->
        <div class="alert alert-info">
            <h5>Import Blogs from Excel File</h5>
            <p>Follow these steps to import blogs:</p>
            <ul>
                <li><strong>Step 1:</strong> Download the <strong><a href="{{ route('dashboard.blogs.downloadSample') }}">Sample File</a></strong> and fill it with your blog data (Title, Content, Slug, Image). The <strong>Image</strong> field will be assigned a default value upon import. If you wish to change it later, you can do so by editing the blog through the <strong><a href="{{ route('dashboard.blogs.index') }}">Blog Edit</a></strong> page.</li>
                <li><strong>Step 2:</strong> Upload the completed Excel file using the form below.</li>
                <li><strong>Step 3:</strong> Click the Import button to add your blogs.</li>
            </ul>
        </div>

        <!-- Export and Import Buttons -->
        <div class="mb-4">
            @can('export_blog')
            <a href="{{ route('dashboard.blogs.export') }}" class="btn btn-success">Export Blogs</a>
            @endcan
            @can('import_blog')
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importModal">
                Import Blogs
            </button>
            @endcan
        </div>

        <!-- Import Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Blogs</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('dashboard.blogs.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload Excel File</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Import Modal -->

        <!-- Blog Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Blog List</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Slug</th>
                                <th>Author</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($blog->content, 50) }}</td>
                                    <td>{{ $blog->slug }}</td>
                                    <td>{{ $blog->user->name ?? 'N/A' }}</td>
                                    <td>
                                        @can('view_blog')
                                        <a href="{{ route('dashboard.blogs.show', $blog->id) }}" class="btn text-info btn-sm">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        @endcan
                                        @can('edit_blog')
                                        <a href="{{ route('dashboard.blogs.edit', $blog->id) }}" class="btn text-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </a>
                                        @endcan
                                        @can('delete_blog')
                                        <form action="{{ route('dashboard.blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash-fill"></i> Delete
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No blogs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Blog Table -->
    </div>
</div>
@endsection
