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
                  <th>Description</th>
                  <th>Photo</th>
                  <th>Condition</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $key => $banner)
                <tr>
                  <td>{{ $key+1}}</td>
                  <td>{{ $banner->title}}</td>
                  <td>{{ $banner->description}}</td>
                  <td>
                    <img src="{{ $banner->photo}}" alt="Banner" height="70" width="70" />
                  </td>
                  <td> 
                    @if($banner->status == 'banner')
                     <span class="badge badge-success">{{ $banner->condition }}</span>
                    @else
                    <span class="badge badge-primary">{{ $banner->condition }}</span>
                    @endif
                  </td>
                  <td>
                    <input type="checkbox" name="toogle" value="{{ $banner->id }}" data-toggle="switchbutton" {{ ($banner->status =='active' ? 'checked' : '') }} data-onlabel="Active" data-size="sm" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                  </td>
                  <td>
                    <a href="" class="btn btn-success">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Sl No.</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Photo</th>
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