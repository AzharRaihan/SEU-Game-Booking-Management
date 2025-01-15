@extends('layouts.student.student-layouts')
@section('title', 'Games Room')
@push('page-css')
<style>
    .message-alert{
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 600;
        background: #ff000036;
    }
    .game-avater img{
        width: 250px;
        height: 150px;
        object-fit: cover;
    }
    .alert-message{
        height: 250px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 25px;
        font-weight: 500;
        background: #ff000029;
    }
    .game_board h4{
        font-size: 16px;
        font-weight: 900;
        letter-spacing: 2px;
    }
    .game_board h6{
        font-size: 13px;
        font-weight: 500;
    }
    .game_board button{
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
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
                    <h4 class="page-title float-left"><span><i class="icon-game-controller"></i></span> Games</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Game Room</a></li>
                        <li class="breadcrumb-item active">Games</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        @if(Auth::user()->status == '1')
        <div class="d-flex flex-wrap">
            @foreach($games as $game)
            <div class="card-box tilebox-one mr-5" style="background-color: {{ $game->board_bg_color }};">
                <div class="d-flex align-items-center">
                    <div class="game-avater">
                        <img src="{{ asset('games/'.$game->game_avater) }}" alt="">
                    </div>
                    <div class="pl-3 game_board">
                        <h4 style="color: {{ $game->board_color }};">{{ $game->game_name }}</h4>
                        <h6 style="color: {{ $game->board_color }};">Board Member: {{ $game->member }}</h6>
                        <h6 style="color: {{ $game->board_color }};">Booked Member: {{ $game->booked_person ? $game->booked_person : '0' }}</h6>
                        @if($game->start_time && $game->end_time)
                        <p class="mb-1" style="color: {{ $game->board_color }};">Start: {{ $game->start_time }} - End: {{ $game->end_time }}</p>
                        @endif
                        @if($game->member == $game->booked_person)
                            <button type="button" class="btn btn-danger">
                                Board Is Full
                            </button>
                        @else 
                            <button type="button" onclick="bookForm({{ $game->id }})" class="btn btn-danger">
                                Book A Slot
                            </button>
                            <form id="bookForm-{{ $game->id }}" action="{{ route('student.book-game', $game->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                        @endif
                        </form>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="card-box alert-message">
                    <p class="mb-0">Please wait until your request is approved, your request is pending!</p>
                </div>
            </div>
        </div>
        @endif
    </div> <!-- container -->
</div> <!-- content --> 
@endsection
@push('page-js')

<!-- Sweet Aleart Js -->
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
  <script type="text/javascript">
  function bookForm(id) {
   Swal.fire({
       title: 'Are you sure?',
       text: "You went to Book this Game",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, Book it!',
       cancelButtonText: 'No, cancel!',
       confirmButtonClass: 'btn btn-success',
       cancelButtonClass: 'btn btn-danger',
       buttonsStyling: false,
       reverseButtons: true
   }).then((result) => {
       if (result.value) {
           event.preventDefault();
           document.getElementById('bookForm-'+id).submit();
       } else if (
           // Read more about handling dismissals
           result.dismiss === Swal.DismissReason.cancel
       ) {
        Swal.fire(
               'Cancelled',
               "You're Not Book any Games :)",
               'info'
           )
       }
   })
 }
 
  </script>
@endpush