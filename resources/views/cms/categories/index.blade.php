@extends('cms.parent')

@section('title', 'Categories')
@section('page-large-name', 'Categories')
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
                            <h3 class="card-title">Categories Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Books</th>
                                        <th>Visible</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        @canany(['Update-Category', 'Delete-Category'])
                                            <th>Settings</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <span class="badge bg-info">({{ $category->books_count }}) Book/s</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge @if ($category->is_visible) bg-success @else bg-danger @endif">{{ $category->visibility_status }}</span>
                                            </td>
                                            <td>{{ $category->created_at->format('Y-m-d h:ia') }}</td>
                                            <td>{{ $category->updated_at->format('Y-m-d h:ia') }}</td>
                                            @canany(['Update-Category', 'Delete-Category'])
                                                <td>
                                                    <div class="btn-group">
                                                        @can('Update-Category')
                                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                                class="btn btn-info">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('Delete-Category')
                                                            <a onclick="deleteCategory({{ $category->id }}, this)"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        @endcan
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
        function deleteCategory(id, reference) {
            confirmDestroy('/cms/admin/categories', id, reference)
        }
    </script>
@endsection
