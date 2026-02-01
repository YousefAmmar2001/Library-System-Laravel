@extends('cms.parent')

@section('title', 'Admins')
@section('page-large-name', 'Admins')
@section('page-small-name', 'Edit')

@section('styles')

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
    <script>
        function updateAdmin(id) {
            let data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value
            }
            updateItem('/cms/admin/admins', id, data, '/cms/admin/admins')
        }
    </script>
@endsection
