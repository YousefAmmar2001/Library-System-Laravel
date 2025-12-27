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
            <form method="POST" action="{{ route('categories.store') }}">
              @csrf
              <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  {{ session()->get('message') }}
                </div>
                @endif
                @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </div>
                @endif
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" value="{{ old('description') }}" name="description" id="description" placeholder="Enter description">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="visible" id="visible" {{ old('visible') == 'on' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="visible">Visible</label>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection