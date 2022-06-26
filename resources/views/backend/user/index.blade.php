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
              <h3 class="card-title">All Users</h3>
              <a href="{{ route('user.create') }}" class="btn btn-success" style="float:right">Add User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Photo</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($users as $key => $user)
       
                    <tr>
                      <td>{{ $key+1}}</td>
                      <td>
                        <img src="{{ $user->photo}}" alt="user" style="height:90px; width:90px; border-radius:50%"  />
                      </td>
                      <td >{{ $user->full_name}}</td>
                      <td >{{ $user->email}}</td>
                      <td >{{ $user->role}}</td>
                     
                       
                      <td>
                        <input type="checkbox" name="toogle" value="{{ $user->id }}" data-toggle="switchbutton" {{ ($user->status =='active' ? 'checked' : '') }} data-onlabel="Active" data-size="sm" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{$user->id}}" class="float-left btn btn-primary mr-1"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('user.edit',$user->id) }}" class="float-left btn btn-success mr-1"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('user.destroy',$user->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <a href="" data-id="{{ $user->id }}" title="Delete" data-toggle="tooltip" class="btn btn-danger deleteBtn float-left"><i class="fa fa-trash"></i></a>
                        </form>

                          <!--show product details -->
                            <div class="modal fade" id="myModal{{$user->id}}">
                              <div class="modal-dialog modal-dialog-centered  modal-lg">
                                <div class="modal-content">
                            <?php 
                              $user = \App\User::where('id',$user->id)->first();
                            ?>
                                  <!-- Modal body -->
                                   <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <img src="{{ $user->photo }}" style="height: 120px; width:120px; border-radius:50%" alt="">
                                            <h4>Username: {{$user->username}}</h4> 
                                            <h4>Full Name: {{$user->full_name}}</h4>
                                         </div>
                                        
                                    </div>
                                        <div class="row">
                                          <div class="col-md-6 mt-2">
                                            <strong>User Email:</strong>
                                            <span>{{ $user->email }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>User Phone:</strong>
                                            <span>{{ $user->phone }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>User Address:</strong>
                                            <span>{{ $user->address }}</span>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                            <strong>User Role:</strong>
                                            <span>{{ $user->role }}</span>
                                          </div>
                                          
                                          <div class="col-md-6 mt-2">
                                            <strong>User Status:</strong>
                                            <span class="badge badge-success">{{ $user->status }}</span>
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
                    <th>Photo</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
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
 