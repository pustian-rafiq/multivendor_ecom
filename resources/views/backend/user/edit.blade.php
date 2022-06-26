@extends('backend.layouts.admin_master');
 <!-- summernote -->
 <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
@section('content')
<section class="content">

  {{-- Show validations error --}}
  <div class="col-12">
    @if($errors->any())
    <div class="alert alert-danger">

      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>

    <div class="container-fluid">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Edit User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('user.store') }}">
          @csrf
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-10">
                <input type="text" name="full_name" value="{{ $user->full_name }}" class="form-control" id="inputEmail3">
              </div>
            </div>
            <div class="form-group row">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" name="username" value="{{ $user->username }}" class="form-control" id="username">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail3" >
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" value="{{ $user->password }}" class="form-control" id="password" >
              </div>
            </div>
            
            <div class="form-group row">
              <label for="phone" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="phone" >
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <input type="text" name="address" value="{{ $user->address }}" class="form-control" id="address" >
              </div>
            </div>
            

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Photo</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                      <i class="fa fa-picture-o"></i> Choose
                    </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $user->photo }}">
                </div>
                <div id="holder" style="margin-top:25px;max-height:100px;"></div>
              </div>
            </div>
          
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Role</label>
              <div class="col-sm-10">
                <select class="form-control" name="role">
                  <option>---Select Status---</option>
                  <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                  <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : ''}}>Vendor</option>
                  <option value="customer" {{ $user->role =='customer' ? 'selected' : ''}}>Customer</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status">
                  <option>---Select Status---</option>
                  <option value="active" {{ $user->status =='active' ? 'selected' : ''}}>Active</option>
                  <option value="inactive" {{ $user->status =='inactive' ? 'selected' : ''}}>Inactive</option>
                </select>
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Update User</button>
            {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
  </section>

@endsection

@section('scripts')
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
   $('#lfm').filemanager('image');
</script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>   
@endsection