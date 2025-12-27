@extends('cms.parent')

@section('title', 'Countries')
@section('page-large-name', 'Countries')
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
              <h3 class="card-title">Create Country</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" id="create-form">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="createCountry()" class="btn btn-primary">Submit</button>
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
      function createCountry(){
        let data = { 
          name: document.getElementById('name').value 
        }
        createItem('/cms/admin/countries', data)
      }
  </script>
@endsection
