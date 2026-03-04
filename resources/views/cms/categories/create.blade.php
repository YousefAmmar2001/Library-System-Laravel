@extends('cms.parent')

@section('title', 'Categories')
@section('page-large-name', 'Categories')
@section('page-small-name', 'Create')

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
                            <h3 class="card-title">Create Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                        placeholder="Enter description">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="visible" id="visible">
                                        <label class="custom-control-label" for="visible">Visible</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="createCategory()" class="btn btn-primary">Submit</button>
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
        function createCategory() {
            let data = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value,
                visible: document.getElementById('visible').checked,
            }
            createItem('/cms/admin/categories', data)
        }
    </script>
@endsection
