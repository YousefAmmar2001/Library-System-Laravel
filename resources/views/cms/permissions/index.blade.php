@extends('cms.parent')

@section('title', 'Permissions')
@section('page-large-name', 'Permissions')
@section('page-small-name', 'Index')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Permissions Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Guard</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Settings</th>
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
                                            <td>{{ $permission->created_at->format('Y-m-d h:ma') }}</td>
                                            <td>{{ $permission->updated_at->format('Y-m-d h:ma') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a onclick="deletePermission({{ $permission->id }}, this)"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
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
        function deletePermission(id, reference) {
            confirmDestroy('/cms/admin/permissions', id, reference)
        }
    </script>
@endsection
