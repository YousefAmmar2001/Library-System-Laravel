@extends('cms.parent')

@section('title', 'Admins')
@section('page-large-name', 'Admins')
@section('page-small-name', 'Edit')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" value="{{ $admin->name }}" name="name"
                                        id="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{ $admin->email }}" name="email"
                                        id="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control roles" id="role_id" style="width: 100%;">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if ($role->name == $assignedRoleName) selected @endif>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="updateAdmin({{ $admin->id }})"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.roles').select2({
            theme: 'bootstrap4'
        })

        function updateAdmin(id) {
            let data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                role_id: document.getElementById('role_id').value,
            }
            updateItem('/cms/admin/admins', id, data, '/cms/admin/admins')
        }
    </script>
@endsection
