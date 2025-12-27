@extends('cms.parent')

@section('title', 'Books')
@section('page-large-name', 'Books')
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
                        <h3 class="card-title">Edit Book</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control categories" id="category_id" style="width: 100%;">
                                    {{-- <option selected="selected">Alabama</option> --}}
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $book->category_id)
                                        selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ $book->name }}" id="name" name="name"
                                    placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" class="form-control" value="{{ $book->year }}" id="year"
                                    placeholder="Enter year">
                            </div>
                            <div class="form-group">
                                <label>Language</label>
                                <select class="form-control languages" id="language" style="width: 100%;">
                                    <option value="en" @if($book->language == 'en') selected @endif>English</option>
                                    <option value="ar" @if($book->language == 'ar') selected @endif>Arabic</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" value="{{ $book->quantity }}" id="quantity"
                                    placeholder="Enter quantity">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="visible" @if
                                        ($book->is_visible) checked @endif>
                                    <label class="custom-control-label" for="visible">Visible</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="updateBook({{ $book->id }})"
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
    $('.categories').select2({
        theme: 'bootstrap4'
    })
    $('.languages').select2({
        theme: 'bootstrap4'
    })

    function updateBook(id) {
        let data = {
            category_id: document.getElementById('category_id').value,
            name: document.getElementById('name').value,
            year: document.getElementById('year').value,
            language: document.getElementById('language').value,
            quantity: document.getElementById('quantity').value,
            visible: document.getElementById('visible').checked,
        }
        updateItem('/cms/admin/books/' + id, data, '/cms/admin/books')
    }

</script>
@endsection