@extends('cms.parent')

@section('title', 'Users')
@section('page-large-name', 'Users')
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
                            <h3 class="card-title">Users Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        @can('Manage-User-Permission')
                                            <th>Permissions</th>
                                        @endcan
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        @canany(['Update-User', 'Delete-User'])
                                            <th>Settings</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            @can('Manage-User-Permission')
                                                <td>
                                                    <a href="{{ route('user.show', $user->id) }}"
                                                        class="btn btn-block bg-gradient-info btn-sm">{{ $user->permissions_count }}
                                                        Permission/s
                                                    </a>
                                                </td>
                                            @endcan
                                            <td>{{ $user->created_at->format('Y-m-d h:ia') }}</td>
                                            <td>{{ $user->updated_at->format('Y-m-d h:ia') }}</td>
                                            @canany(['Update-User', 'Delete-User'])
                                                <td>
                                                    <div class="btn-group">
                                                        @can('Update-User')
                                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('Delete-User')
                                                            <a onclick="deleteUser({{ $user->id }}, this)"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcanany
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
        function deleteUser(id, reference) {
            confirmDestroy('/cms/admin/users', id, reference)
        }
    </script>
@endsection
