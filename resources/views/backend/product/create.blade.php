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
          <h3 class="card-title">Product Add Form</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('product.store') }}">
          @csrf
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" name="title" value="{{ old('title')}}" class="form-control" id="inputEmail3" placeholder="Enter title">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Summary</label>
              <div class="col-sm-10">
                <div class="card card-outline card-info">
                  <div class="card-header">
                    <h3 class="card-title">
                      Summernote
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body"  style="min-height: 50%">
                    <textarea id="summary" name="summary"> 
                      
                    </textarea>
                  </div>
                </div>
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
                    <textarea id="description" name="description"> 
                      
                    </textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Stock</label>
                <div class="col-sm-10">
                  <input type="text" name="stock" value="{{ old('stock')}}" class="form-control" id="inputEmail3" placeholder="Enter stock">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                  <input type="text" name="price" value="{{ old('price')}}" class="form-control" id="inputEmail3" placeholder="Enter price">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Discount</label>
                <div class="col-sm-10">
                  <input type="text" name="discount" value="{{ old('discount')}}" class="form-control" id="inputEmail3" placeholder="Enter discount">
                </div>
              </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Product Photo</label>
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
              <label for="inputPassword3" class="col-sm-2 col-form-label">Brand</label>
              <div class="col-sm-10">
                <select  class="form-control" name="brand_id">
                  <option>----select Brand---</option>
                  @foreach($brands as $brand)
                  <option value="{{ $brand->id}}">{{ $brand->title }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
              <div class="col-sm-10">
                <select id="cat_id" class="form-control" name="cat_id">
                  <option>----select Category---</option>
                  @foreach(\App\Category::where('is_parent',1)->get() as $parent_cat)
                    <option value="{{ $parent_cat->id }}">{{ $parent_cat->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- Show child category when selected a parent category --using ajax --}}
            <div class="form-group row d-none" id="child_cat_div">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Child Category</label>
              <div class="col-sm-10">
                <select id="child_cat_id" class="form-control" name="child_cat_id">
                  
    
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Size</label>
              <div class="col-sm-10">
                <select class="form-control" name="size">
                  <option>----Select Size---</option>
                  <option value="S" {{ old('size') =='S' ? 'selected' : ''}}>Small</option>
                  <option value="M" {{ old('size') =='M' ? 'selected' : ''}}>Medium</option>
                  <option value="L" {{ old('size') =='L' ? 'selected' : ''}}>Large</option>
                  <option value="XL" {{ old('size') =='XL' ? 'selected' : ''}}>Extra Large</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Conditions</label>
              <div class="col-sm-10">
                <select class="form-control" name="conditions">
                  <option>---Select Conditions---</option>
                  <option value="new" {{ old('conditions') =='new' ? 'selected' : ''}}>New</option>
                  <option value="winter" {{ old('conditions') =='winter' ? 'selected' : ''}}>Winter</option>
                  <option value="popular" {{ old('conditions') =='popular' ? 'selected' : ''}}>Popular</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Vendor</label>
              <div class="col-sm-10">
                <select class="form-control" name="vendor_id">
                  <option>----Select Vendor---</option>
                  @foreach($vendors as $vendor)
                  <option value="{{ $vendor->id }}" {{ old('vendors') =='new' ? 'selected' : ''}}>{{ $vendor->full_name }}</option>
                   @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status">
                  <option>----select status---</option>
                  <option value="active" {{ old('status') =='active' ? 'selected' : ''}}>Active</option>
                  <option value="inactive" {{ old('status') =='inactive' ? 'selected' : ''}}>Inactive</option>
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
    $('#description').summernote()
    $('#summary').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>   

{{-- Get child category after selecting the parent category --}}
<script>
    $('#cat_id').change(function(){

        var cat_id = $(this).val();

        if(cat_id != null){
           $.ajax({
            url:"/admin/category/"+cat_id+"/child",
            type: "POST",
            data: {
                _token: "{{ csrf_token()}}",
                cat_id: cat_id
            },

            success: function(response){
                    var html_option = "<option value=''>---Select Child Category---</option>";
                    console.log(response)
                    if(response.status){
                        console.log("if")
                        $('#child_cat_div').removeClass('d-none');

                        $.each(response.data, function(id,title){
                            html_option += "<option value='"+id+"'>"+title+"</option>"
                        });
                    }else{
                        console.log("else")
                        $('#child_cat_div').addClass('d-none');
                    }

                    //add the options in the child_cat_div
                    $('#child_cat_id').html(html_option)
                }
           })
        }

    });
</script>
@endsection