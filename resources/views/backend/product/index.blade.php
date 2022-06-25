@extends('backend.layouts.admin_master');
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            {{-- Show error or succes notification --}}
                <div class="col-12">
                  @include('backend.layouts.notifications')
                </div>

            <div class="card-header">
              <h3 class="card-title">All Products</h3>
              <a href="{{ route('product.create') }}" class="btn btn-success" style="float:right">Add Product</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Title</th>
                  <th>Photo</th>
                  <th>Price</th>
                  <th>Discount</th>
                  <th>Size</th>
                  <th>Condition</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($products as $key => $product)
                    <tr>
                      <td>{{ $key+1}}</td>
                      <td>{{ $product->title}}</td>
                      <td>
                        <img src="{{ $product->photo}}" alt="brand" height="70" width="70" />
                      </td>
                      <td >{{ $product->price}}</td>
                      <td >{{ $product->discount}}</td>
                      <td >{{ $product->size}}</td>
                     
                        @if($product->conditions == 'new')
                        <td >{{ $product->conditions}}</td>
                        @elseif($product->conditions == 'winter')
                        <td >{{ $product->conditions}}</td>
                        @else
                        <td>{{ $product->conditions}}</td>
                        @endif
                      <td>
                        <input type="checkbox" name="toogle" value="{{ $product->id }}" data-toggle="switchbutton" {{ ($product->status =='active' ? 'checked' : '') }} data-onlabel="Active" data-size="sm" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{$product->id}}" class="float-left btn btn-primary mr-1"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('product.edit',$product->id) }}" class="float-left btn btn-success mr-1"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('product.destroy',$product->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <a href="" data-id="{{ $product->id }}" title="Delete" data-toggle="tooltip" class="btn btn-danger deleteBtn float-left"><i class="fa fa-trash"></i></a>
                        </form>

                          <!--show product details -->
                            <div class="modal fade" id="myModal{{$product->id}}">
                              <div class="modal-dialog modal-dialog-centered  modal-lg">
                                <div class="modal-content">
                            <?php 
                              $product = \App\Product::where('id',$product->id)->first();
                            ?>
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Product Details</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                            
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-4">
                                       <img src="{{ $product->photo }}" width="200" height="200" alt="">
                                      </div>
                                      <div class="col-md-8">
                                        <div class="row">
                                          <div class="col-md-6 mt-2">
                                            <strong>Product Title:</strong>
                                            <span>{{ $product->title }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>Price:</strong>
                                            <span>{{ $product->price }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>Discount:</strong>
                                            <span>{{ $product->discount }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>Offer Price:</strong>
                                            <span>{{ $product->offer_price }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>Brand:</strong>
                                            <span>{{ \App\Brand::where('id',$product->brand_id)->value('title') }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>category:</strong>
                                            <span>{{ \App\Category::where('id',$product->cat_id)->value('title') }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>Size:</strong>
                                            <span class="badge badge-secondary">{{ $product->size }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>Conditions:</strong>
                                            <span>{{ $product->conditions }}</span>
                                          </div>
                                          
                                          <div class="col-md-6 mt-2">
                                            <strong>Status:</strong>
                                            <span class="badge badge-success">{{ $product->status }}</span>
                                          </div>
                                        </div>
                                      </div>
                                      
                                     
                                    </div>
                                    <div class="row mt-4 text-justify px-5">
                                      <div class="col-md-12">
                                        <strong>Summary:</strong>
                                        <span>{{ $product->summary }}</span>
                                      </div>
                                    </div>
                                    <div class="row mt-4  text-justify px-5">
                                      <div class="col-md-12">
                                        <strong>Description:</strong>
                                        <span>{{ $product->description }}</span>
                                      </div>
                                    </div>
                                  </div>
                            
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>
                            
                                </div>
                              </div>
                            </div>
                            
                      </td>
                    </tr>
                 @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                    <th>Sl No.</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Size</th>
                    <th>Condition</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->

          

          </div>
    </div><!-- /.container-fluid -->
  </section>

@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--Banner delete section-->
<script>
      $.ajaxSetup({
        headers: {
          'X-CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $('.deleteBtn').click(function(e){
        var form = $(this).closest('form')
        var dataId = $(this).data('id')
        e.preventDefault()
        swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        form.submit()
        swal("Poof! Your imaginary file has been deleted!", {
          icon: "success",
        });
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  })
</script>

<!--Status change script-->
<script>
  $('input[name=toogle]').change(function(){
    var mode = $(this).prop('checked')
    var id= $(this).val()
     //alert(id)
    $.ajax({
      url: "{{ route('product.status')}}",
      type: "POST",
      data: {
        _token: '{{csrf_token()}}',
        mode: mode,
        id: id
      },
      success: function(response){
        
        if(response.status){
          alert(response.msg)
        }else{
          alert("Try again")
        }
      }
    })
  })
</script>
@endsection
 