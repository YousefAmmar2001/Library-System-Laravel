@extends('cms.parent')

@section('title', 'User Permissions')
@section('page-large-name', 'User Permissions')
@section('page-small-name', 'Index')

@section('styles')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $user->name }} Permissions</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Permission Name</th>
                                        <th>Permission Guard</th>
                                        <th>Assigned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $permission->guard_name }}</span>
                                            </td>
                                            <td>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="permission_{{ $permission->id }}"
                                                        onclick="assignPermission('{{ $user->id }}', '{{ $permission->id }}')"
                                                        @if ($permission->assigned) checked @endif>
                                                    <label for="permission_{{ $permission->id }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script>
        function assignPermission(userId, permissionId) {
            let data = {
                user_id: userId,
                permission_id: permissionId
            }
            axios.post('/cms/admin/permissions/user', data).then(function(response) {
                toastr.success(response.data.message)
            }).catch(function(error) {
                toastr.error(error.response.data.message)
            });
        }
    </script>
@endsection
