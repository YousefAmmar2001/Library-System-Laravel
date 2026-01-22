@extends('cms.parent')

@section('title', 'Change Password')
@section('page-large-name', 'My Password')
@section('page-small-name', 'Change-Password')

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
              <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="change-password-form">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="password">Current Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter current password">
                </div>
                <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input type="password" class="form-control" id="new_password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                  <label for="new_password_confirmation">New Password Confirmation</label>
                  <input type="password" class="form-control" id="new_password_confirmation" placeholder="Confirm new password">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="changePassword()" class="btn btn-primary">Submit</button>
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
    function changePassword() {
        axios.post('/cms/admin/change-password', {
          password: document.getElementById('password').value,
          new_password: document.getElementById('new_password').value,
          new_password_confirmation: document.getElementById('new_password_confirmation').value,
        }).then(function (response) {
          document.getElementById('change-password-form').reset();
          toastr.success(response.data.message);
        }).catch(function (error) {
          toastr.error(error.response.data.message)
        });
      }
  </script>
@endsection
