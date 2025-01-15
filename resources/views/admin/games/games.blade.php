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
  .page-title-box{
    padding: 14px 20px !important;
  }
  .color-picker-box{
    height: 25px; 
    width: 70px; 
    border-radius: 4px;
  }
</style>
@endpush
@section('page-content')
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12">
          <div class="page-title-box">
            <div class="d-flex justify-content-between align-items-center text-muted">
              <h4 class="page-title float-left">
              <i class="icon-game-controller"></i> Games</h4>
              <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">
                  <a href="{{ route('admin.create-game')}}" class="btn btn-dark">
                    <i class="fa fa-plus-circle"></i>
                    <span>Create Game</span>
                  </a>
                </li>
              </ol>
            </div>
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
                      <th>Game Name</th>
                      <th>Member</th>
                      <th>Joined Person</th>
                      <th>Board Background Color</th>
                      <th>Board Color</th>
                      <th>Status</th>
                      <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($games as $key=>$game)
                    <tr>
                      <td>#{{ $key + 1 }}</td>
                      <td>{{ $game->game_name }}</td>
                      <td>
                        <span class="badge badge-danger">{{ $game->member }}</span>
                      </td>
                      <td>
                        <span class="badge {{ $game->booked_person != '' ? ($game->member === $game->booked_person ? 'badge-danger' : 'badge-warning') : '' }}">{{ $game->booked_person != '' ? ($game->member === $game->booked_person ? 'Full' : $game->booked_person) : '' }}</span>
                      </td>
                      <td>
                        <p class="color-picker-box" style="background-color: {{ $game->board_bg_color }};"></p>
                      </td>
                      <td>
                        <p class="color-picker-box" style="background-color: {{ $game->board_color }};"></p>
                      </td>
                      <td>
                        @if($game->status == 'on')
                        <span class="badge badge-dark">Active</span>
                        @else
                        <span class="badge badge-danger">Inactive</span>
                        @endif
                      </td>
                      <td class="action-button text-center">
                        <div>
                          <a href="{{ route('admin.edit-game', $game->id) }}" class="btn btn-dark btn-sm">
                            <i class="fa fa-edit"></i>
                          </a>
                          <button type="button" onclick="deleteData({{ $game->id }})" class="btn btn-danger rounded-right btn-sm">
                            <i class="fa fa-trash-o"></i>
                          </button>
                          <form id="deleteForm-{{ $game->id }}" action="{{ route('admin.delete-game', $game->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                          </form>
                        </div>
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




 <!-- Sweet Aleart Js -->
 <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
  <script type="text/javascript">
  function deleteData(id) {
   Swal.fire({
       title: 'Are you sure?',
       text: "You went to delete this Game",
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
