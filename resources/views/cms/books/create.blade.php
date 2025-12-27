@extends('cms.parent')

@section('title', 'Books')
@section('page-large-name', 'Books')
@section('page-small-name', 'Create')

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
              <h3 class="card-title">Create Book</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" id="create-form">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control categories" id="category_id" style="width: 100%;">
                    {{-- <option selected="selected">Alabama</option> --}}
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="year">Year</label>
                  <input type="number" class="form-control" id="year" placeholder="Enter year">
                </div>
                <div class="form-group">
                  <label>Language</label>
                  <select class="form-control languages" id="language" style="width: 100%;">
                      <option value="en">English</option>
                      <option value="ar">Arabic</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input type="number" class="form-control" id="quantity" placeholder="Enter quantity">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="visible" checked>
                    <label class="custom-control-label" for="visible">Visible</label>
                  </div>
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
  <!-- Select2 -->
  <script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>

    $('.categories').select2({
      theme: 'bootstrap4'
    })
    $('.languages').select2({
      theme: 'bootstrap4'
    })

    function createCountry(){
      let data = {
        category_id: document.getElementById('category_id').value,
        name: document.getElementById('name').value,
        year: document.getElementById('year').value,
        language: document.getElementById('language').value,
        quantity: document.getElementById('quantity').value,
        visible: document.getElementById('visible').checked
      }

      createItem('/cms/admin/books', data)
    }

  </script>
@endsection