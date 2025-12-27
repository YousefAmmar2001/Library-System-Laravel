@extends('cms.parent')

@section('title', 'Books')
@section('page-large-name', 'Books')
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
                        <h3 class="card-title">Books Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Year</th>
                                    <th>Language</th>
                                    <th>Quantity</th>
                                    <th>Visible</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->category->name }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $book->year }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $book->language_name }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $book->quantity }}</span>
                                        </td>
                                        <td>
                                            <span class="badge @if ($book->is_visible) bg-success @else bg-danger @endif">{{ ($book->is_visible ? "True" : "False") }}</span>
                                        </td>
                                        <td>{{ $book->created_at->format('Y-m-d h:ma') }}</td>
                                        <td>{{ $book->updated_at->format('Y-m-d h:ma') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a onclick="deleteBook({{ $book->id }}, this)" class="btn btn-danger">
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
    function deleteBook(id, reference){
            confirmDestroy('/cms/admin/books', id, reference)
        }
</script>
@endsection