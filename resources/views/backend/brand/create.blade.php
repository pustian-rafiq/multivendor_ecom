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
          <h3 class="card-title">Brand Add Form</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('brand.store') }}">
          @csrf
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" name="title" value="{{ old('title')}}" class="form-control" id="inputEmail3" placeholder="Enter title">
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
                  <input id="thumbnail" class="form-control" type="text" name="photo">
                </div>
                <div id="holder" style="margin-top:25px;max-height:100px;"></div>
              </div>
            </div>
          
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status">
                  <option>----select status---</option>
                  <option value="active" {{ old('role') =='active' ? 'selected' : ''}}>Active</option>
                  <option value="inactive" {{ old('role') =='inactive' ? 'selected' : ''}}>Inactive</option>
                </select>
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Save Brand</button>
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