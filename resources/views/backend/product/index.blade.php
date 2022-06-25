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
              <h3 class="card-title">All Banners</h3>
              <a href="{{ route('banner.create') }}" class="btn btn-success" style="float:right">Add Banner</a>
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
                        <a href="{{ route('product.edit',$product->id) }}" class="float-left btn btn-success mr-1">Edit</a>
                        <form action="{{ route('product.destroy',$product->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <a href="" data-id="{{ $product->id }}" title="Delete" data-toggle="tooltip" class="btn btn-danger deleteBtn float-left">Delete</a>
                        </form>
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
      url: "{{ route('banner.status')}}",
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
 