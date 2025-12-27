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
                                    <th>Settings</th>
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
                                            <span class="badge @if ($category->is_visible) bg-success @else bg-danger @endif">{{ $category->visibility_status }}</span>
                                        </td>
                                        <td>{{ $category->created_at->format('Y-m-d h:ma') }}</td>
                                        <td>{{ $category->updated_at->format('Y-m-d h:ma') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
    
@endsection