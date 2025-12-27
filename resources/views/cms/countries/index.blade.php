@extends('cms.parent')

@section('title', 'Countries')
@section('page-large-name', 'Countries')
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
                        <h3 class="card-title">Countries Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td> 
                                        <td>{{ $country->created_at->format('Y-m-d h:ma') }}</td>
                                        <td>{{ $country->updated_at->format('Y-m-d h:ma') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a onclick="deleteCountry({{ $country->id }}, this)" class="btn btn-danger">
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
        function deleteCountry(id, reference){
            confirmDestroy('/cms/admin/countries', id, reference)
        }
    </script>
@endsection
