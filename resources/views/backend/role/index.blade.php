@extends('backend.layouts.master')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Section 1: Create Role --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create New Role</h4>
                                <form id="createRoleForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Role Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Role</button>
                                </form>
                                <div id="createRoleMsg" class="mt-2"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Assign Permissions --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Assign Permissions to Role</h4>
                                <form id="assignPermissionsForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Select Role</label>
                                        <select name="role_id" class="form-control" required id="roleDropdown">
                                            <option value="">-- Select Role --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Permissions</label>
                                        <div id="permissionsCheckboxes" class="row">
                                            @foreach ($permissions as $permission)
                                                <div class="col-md-4 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $permission->name }}" id="perm}">
                                                        <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                            {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Assign Permissions</button>
                                </form>
                                <div id="assignPermissionMsg" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Roles Index --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Roles & Their Permissions</h4>
                                <table class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Role Name</th>
                                            <th>Permission Name</th>
                                        </tr>
                                    </thead>

                                    <tbody id='permission'>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @foreach ($role->permissions as $permission)
                                                        <span class=" fs-15 badge bg-success  ">{{ $permission->name }}</span>
                                                    @endforeach
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

    <script>
        $(document).ready(function() {
            // Create Role
            $('#createRoleForm').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('roles.store') }}",
                    method: "POST",
                    data: formData,
                    success: function(res) {
                        $('#createRoleMsg').html(
                            '<span class="text-success">Role created successfully!</span>');
                        $('#createRoleForm')[0].reset();
                        var newRoleOption =
                            `<option value="${res.role.id}">${res.role.name}</option>`;
                        $('#roleDropdown').append(newRoleOption);
                    },
                    error: function(err) {
                        $('#createRoleMsg').html('<span class="text-danger">' + err.responseJSON
                            .message + '</span>');
                    }
                });
            });
            $('#roleDropdown').on('change', function() {
                var value = $(this).val();
                var url = "{{ route('find.permissions', 'permission') }}";
                url = url.replace('permission', value);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(res) {
                        $('.form-check-input').prop('checked', false);

                        res.permissions.forEach(function(perm) {
                            $('.form-check-input').each(function() {
                                if ($(this).val() === perm.name) {
                                    $(this).prop('checked',
                                        true); // Check the correct checkbox
                                }
                            });
                        });

                    }
                });


            });

            // Assign Permissions
            $('#assignPermissionsForm').submit(function(e) {
                e.preventDefault();
                if ($('input[name="permissions[]"]:checked').length === 0) {
                    $('#assignPermissionMsg').html(
                        '<span class="text-danger">Please select at least one permission.</span>');
                    return;
                }
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('roles.assign.permissions') }}",
                    method: "POST",
                    data: formData,
                    success: function(res) {

                        $('#assignPermissionMsg').html(
                            '<span class="text-success">Permissions assigned successfully!</span>'
                        );
                        $('#assignPermissionsForm')[0].reset();


                        $('#permission').html(res);
                    },
                    error: function(err) {
                        $('#assignPermissionMsg').html('<span class="text-danger">' + err
                            .responseJSON.message + '</span>');
                    }
                });
            });
        });
    </script>
@endsection
