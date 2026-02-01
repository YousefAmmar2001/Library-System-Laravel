@extends('cms.parent')

@section('title', 'Permissions')
@section('page-large-name', 'Permissions')
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
                            <h3 class="card-title">Edit Permission</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Guard</label>
                                    <select class="form-control guards" id="guard" style="width: 100%;" disabled>
                                        <option value="admin" @if ($permission->guard_name == 'admin') selected @endif>
                                            Admin
                                        </option>
                                        <option value="user" @if ($permission->guard_name == 'user') selected @endif>
                                            User
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" value="{{ $permission->name }}"
                                        id="name" name="name" placeholder="Enter name">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="updatePermission({{ $permission->id }})"
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
        $('.guards').select2({
            theme: 'bootstrap4'
        })

        function updatePermission(id) {
            let data = {
                name: document.getElementById('name').value,
            }
            updateItem('/cms/admin/permissions', id, data, '/cms/admin/permissions')
        }
    </script>
@endsection
