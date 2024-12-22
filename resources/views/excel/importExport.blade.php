@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Import and Export Users</h2>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card bg-light mt-3">
        <div class="card-header">
            Import and Export Users
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Import Users:</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button class="btn btn-success mt-2">Import Users</button>
            </form>

            <form action="{{ route('export') }}" method="GET" class="mt-3">
                @csrf
                <button class="btn btn-warning">Export Users</button>
            </form>
        </div>
    </div>
</div>
@endsection
