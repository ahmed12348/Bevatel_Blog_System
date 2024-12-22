@extends('dashboard.layout')

@section('title', 'Role Management')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Roles</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role Management</li>
                </ol>
            </nav>
        </div>
        
        <div class="ms-auto">
            <div class="btn-group">
                <!-- Only show the button if the user has the 'role-create' permission -->
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('dashboard.roles.create') }}"> Create New Role</a>
                @endcan
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Roles</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" type="text" placeholder="Search">
                </form>
            </div>

            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th> <!-- Counter column -->
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Counter -->
                                <td>{{ $role->name }}</td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <!-- Edit Role: Only visible to users with 'role-edit' permission -->
                                        @can('role-edit')
                                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        @endcan

                                        <!-- Delete Role: Only visible to users with 'role-delete' permission -->
                                        @can('role-delete')
                                            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-link p-0 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete this role?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination Links -->
    {!! $roles->render() !!}
@endsection
