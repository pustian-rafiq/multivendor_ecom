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
          <h3 class="card-title">Edit Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">
          @csrf
          {{ method_field('PUT') }}
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" name="title" value="{{ $category->title }}" class="form-control" id="inputEmail3" >
                @error('title')
                <span class="text-danger">{{ $message }}</span>
              @endif
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
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $category->photo }}">
                </div>
                <div id="holder" style="margin-top:25px;max-height:100px;"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <div class="card card-outline card-info">
                  <div class="card-header">
                    <h3 class="card-title">
                      Summernote
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body"  style="min-height: 50%">
                    <textarea id="summernote" name="summary"> 
                      {{$category->summary}}
                    </textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <label for="inputEmail3" class="">Is Parent</label>
                <input type="checkbox" name="is_parent" value="{{$category->is_parent}}" {{$category->is_parent == true ? 'checked' : ''}}  id="is_parent" >Yes
              </div>
            </div>
            
            <div class="form-group row {{ $category->is_parent ==1 ? 'd-none' : ''}}" id="parent_cat_div">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Parent Category</label>
              <div class="col-sm-10">
                <select class="form-control" name="parent_id">
                  <option value="">----Select Parent Category---</option>
                  @foreach ($parentCategories as $item)
                      
                   <option value="{{ $item->id}}" {{ $category->parent_id == $item->id ? 'selected' : ''}}>{{ $item->title }}</option>
                  @endforeach
                  
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status">
                  <option value="">----select status---</option>
                  <option value="active"  {{ $category->status =='active' ? 'selected' : ''}}>Active</option>
                  <option value="inactive" {{ $category->status =='inactive' ? 'selected' : ''}}>Inactive</option>
                </select>
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Save Banner</button>
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

<!-- Show or hide parent category-->
<script>
   $('#is_parent').change(function(e){
    e.preventDefault();

    var is_checked = $('#is_parent').prop('checked')
    if(is_checked){
      $('#parent_cat_div').addClass('d-none')
    }else{
      $('#parent_cat_div').removeClass('d-none')
    }
   })
 
</script>   
@endsection