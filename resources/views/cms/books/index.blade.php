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
                                        @canany(['Update-Book', 'Delete-Book', 'Restore-Book'])
                                            <th>Settings</th>
                                        @endcanany
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
                                                <span
                                                    class="badge @if ($book->is_visible) bg-success @else bg-danger @endif">{{ $book->is_visible ? 'True' : 'False' }}</span>
                                            </td>
                                            <td>{{ $book->created_at->format('Y-m-d h:ia') }}</td>
                                            <td>{{ $book->updated_at->format('Y-m-d h:ia') }}</td>
                                            @canany(['Update-Book', 'Delete-Book', 'Restore-Book'])
                                                <td>
                                                    <div class="btn-group">
                                                        @can('Update-Book')
                                                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @if ($book->trashed())
                                                            @can('Restore-Book')
                                                                <a onclick="toggleBook({{ $book->id }}, this)"
                                                                    class="btn btn-warning">
                                                                    <i class="fas fa-trash-restore"></i>
                                                                </a>
                                                            @endcan
                                                        @else
                                                            @can('Delete-Book')
                                                                <a onclick="toggleBook({{ $book->id }}, this)"
                                                                    class="btn btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            @endcan
                                                        @endif
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
        function toggleBook(id, reference) {

            let isRestore = $(reference).hasClass('btn-warning');

            let confirmText = isRestore ? "Yes, restore it!" : "Yes, delete it!";

            Swal.fire({
                title: "Are you sure?",
                text: "You can change the status later!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: confirmText
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = isRestore ? '/cms/admin/books/' + id + '/restore' : '/cms/admin/books/' + id;
                    let method = isRestore ? 'put' : 'delete';

                    axios({
                        method: method,
                        url: url
                    }).then(function(response) {
                        showMessage(response.data);

                        let row = $(reference).closest('tr');

                        row.find('td:eq(8)').text(response.data.updated_at);

                        if (isRestore) {
                            $(reference).removeClass('btn-warning').addClass('btn-danger')
                                .find('i').removeClass('fas fa-trash-restore').addClass('fas fa-trash');
                        } else {
                            $(reference).removeClass('btn-danger').addClass('btn-warning')
                                .find('i').removeClass('fas fa-trash').addClass('fas fa-trash-restore');
                        }
                    }).catch(function(error) {
                        showMessage(error.response.data);
                    });
                }
            });
        }
    </script>
@endsection
