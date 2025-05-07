@extends('backend.layouts.master')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- Create User Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create New User</h4>

                                <form action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">User Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_name" class="form-label">Role</label>
                                            <select class="form-control" id="role_name" name="role_name" required>
                                                @foreach (Spatie\Permission\Models\Role::select('id', 'name')->get() as $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                >
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>
                                   </div>

                                    <button type="submit" class="btn btn-primary">Create User</button>
                                    {{-- <a href="{{ route(name: 'user.index') }}" class="btn btn-secondary">Cancel</a> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users List -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Users</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Models\User::all() as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->getRoleNames()->first() }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                        Edit
                                                    </button>

                                                    <!-- Edit User Modal -->
                                                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="mb-3">
                                                                            <label for="name" class="form-label">User Name</label>
                                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="email" class="form-label">Email</label>
                                                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="role_name" class="form-label">Role</label>
                                                                            <select class="form-control" id="role_name" name="role_name" required>
                                                                                @foreach (Spatie\Permission\Models\Role::select('id', 'name')->get() as $role)
                                                                                    <option value="{{ $role->name }}" {{ $role->name === $user->getRoleNames()->first() ? 'selected' : '' }}>
                                                                                        {{ $role->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                                                                            <input type="password" class="form-control" id="password" name="password">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                                        </div>

                                                                        <button type="submit" class="btn btn-primary">Update User</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
