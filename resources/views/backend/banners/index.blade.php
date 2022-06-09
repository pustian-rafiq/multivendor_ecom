@extends('backend.layouts.admin_master');

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
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
                  <td>{{ $banner->slug}}</td>
                  <td>{{ $banner->description}}</td>
                  <td>
                    <img src="{{ $banner->photo}}" alt="Banner" height="70" width="70" />
                  </td>
                  <td>{{ $banner->condition}}</td>
                  <td>{{ $banner->status}}</td>
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