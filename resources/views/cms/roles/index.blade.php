@extends('cms.parent')

@section('title', 'Roles')
@section('page-large-name', 'Roles')
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
                            <h3 class="card-title">Roles Table</h3>
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
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $role->guard_name }}</span>
                                            </td>
                                            <td>{{ $role->created_at->format('Y-m-d h:ma') }}</td>
                                            <td>{{ $role->updated_at->format('Y-m-d h:ma') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a onclick="deleteRole({{ $role->id }}, this)"
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
        function deleteRole(id, reference) {
            confirmDestroy('/cms/admin/roles', id, reference)
        }
    </script>
@endsection
