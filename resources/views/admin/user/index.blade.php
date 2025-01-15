@extends('layouts.backend.backend-layouts')
@section('page-title','Admin-Dashboard | LaraStarter')
@push('page-css')
<!-- DataTables -->
<link href="{{ asset('assets/backend/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/backend/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/backend/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<style>
  .avater img{
    object-fit: cover;
  }
</style>
@endpush
@section('page-content')
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12">
          <div class="page-title-box text-muted">
            <h4 class="page-title float-left">
              <span><i class="icon-people"></i></span> Member Approval
            </h4>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item"><a href="#">Game Room</a></li>
              <li class="breadcrumb-item active">Member Approval</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- end row -->
      <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
              <table id="responsive-datatable" class="table dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                      <th>#SL</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Joined At</th>
                      <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key=>$user)
                    <tr>
                      <td>#{{ $key + 1 }}</td>
                      <td class="d-flex">
                        <div class="avater">
                          @isset($user->profile_photo)
                          <img width="40" height="40" class="rounded-circle"
                          src="{{ asset('users/profile-pic/'. $user->profile_photo) }}" alt="user-avatar">
                          @else
                          <img width="40" height="40" class="rounded-circle"
                          src="{{ asset('default-avater/default.png') }}" alt="default-avatar">
                          @endisset
                        </div>
                        <div class="ml-2">
                          <div>{{ $user->name }}</div>
                          @if ($user->role)
                            <span class="badge badge-info text-uppercase">{{ $user->role->name }}</span>
                          @else
                            <span class="badge badge-danger text-uppercase">No role found</span>
                          @endif
                        </div>
                      </td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if($user->status == true)
                          <span class="badge badge-info">Active</span>
                        @else
                          <span class="badge badge-danger">Inactive</span>
                        @endif
                      </td>
                      <td>{{ $user->created_at->diffForHumans() }}</td>
                      <td class="text-center action-button">
                        <div class="btn-group">
                          @if($user->status == false)
                          <button type="button" class="btn btn-warning rounded-right btn-sm" onclick="approvedUser({{ $user->id }})">
                            Approve
                          <i class=" icon-question"></i>
                          </button>
                          <form id="approveUser-{{ $user->id }}" action="{{ route('admin.user.approve', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('POST')
                          </form>
                          @else
                          <span class="badge badge-dark">
                            Approved
                          </span>
                          @endif
                        </div>

                        <button type="button" onclick="deleteData({{ $user->id }})" class="btn btn-danger rounded-right btn-sm">
                          <i class="fa fa-trash-o"></i>
                        </button>
                        <form id="deleteForm-{{ $user->id }}" action="{{ route('admin.user-delete', $user->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('DELETE')
                        </form>

                      </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
        </div>
    </div>
    <!-- end row -->
    </div> <!-- container -->
  </div>
  <!-- content -->
@endsection
@push('page-js')

 <!-- Sweet Aleart Js -->
 <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

  <!-- Required datatable js -->
  <script src="{{ asset('assets/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('assets/backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/backend/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
  <!-- Selection table -->
  <script src="{{ asset('assets/backend/plugins/datatables/dataTables.select.min.js') }}"></script>
  <script>
    $(document).ready(function() {
        // Default Datatable
        $('#datatable').DataTable();
        // Responsive Datatable
        $('#responsive-datatable').DataTable();
        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    } );
  </script>

<script type="text/javascript">
  function approvedUser(id) {
   Swal.fire({
       title: 'Are you sure?',
       text: "You went to approve this User ",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, approve it!',
       cancelButtonText: 'No, cancel!',
       confirmButtonClass: 'btn btn-success',
       cancelButtonClass: 'btn btn-danger',
       buttonsStyling: false,
       reverseButtons: true
   }).then((result) => {
       if (result.value) {
           event.preventDefault();
           document.getElementById('approveUser-'+id).submit();
       } else if (
           // Read more about handling dismissals
           result.dismiss === Swal.DismissReason.cancel
       ) {
        Swal.fire(
               'Cancelled',
               'The user request pending :)',
               'info'
           )
       }
   })
 }
  </script>

 <!-- Sweet Aleart Js -->
 <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
  <script type="text/javascript">
  function deleteData(id) {
   Swal.fire({
       title: 'Are you sure?',
       text: "You went to delete this User",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, delete it!',
       cancelButtonText: 'No, cancel!',
       confirmButtonClass: 'btn btn-success',
       cancelButtonClass: 'btn btn-danger',
       buttonsStyling: false,
       reverseButtons: true
   }).then((result) => {
       if (result.value) {
           event.preventDefault();
           document.getElementById('deleteForm-'+id).submit();
       } else if (
           // Read more about handling dismissals
           result.dismiss === Swal.DismissReason.cancel
       ) {
        Swal.fire(
               'Cancelled',
               'Your data safe :)',
               'info'
           )
       }
   })
 }
 
  </script>
@endpush



