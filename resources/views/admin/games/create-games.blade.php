@extends('layouts.backend.backend-layouts')
@section('page-title','Admin-Dashboard | LaraStarter')
@push('page-css')
<!-- form Uploads -->
<link href="{{ asset('assets/backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Switchery css -->
<link href="{{ asset('assets/backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
<style>
  .switchery-demo .switchery {
    margin-bottom: 5px;
  }
  .page-title-box{
    padding: 14px 20px !important;
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
              <h4 class="page-title float-left"><i class="icon-people"></i> Games</h4>
              <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">
                  <a href="{{ route('admin.game-list') }}" class="btn btn-danger">
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span>Back to Game List</span>
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
          <form id="roleFrom" role="form" method="POST" action="{{ isset($game) ? route('admin.update-game', $game->id) : route('admin.store-game') }}" enctype="multipart/form-data">
            @csrf
            @isset($game)
              @method('PUT')
            @else
              @method('POST')
            @endisset
            <div class="row">
              <div class="col-md-7">
                <div class="card-box">
                    <h5 class="header-title text-upper">Game Info</h5>
                    <fieldset class="form-group">
                      <label for="game_name">Game Name</label>
                      <input type="text" class="form-control @error('game_name') is-invalid @enderror" value="{{ isset($game) ? $game->game_name : '' }}" id="game_name" name="game_name" placeholder="Game Name">
                      @error('game_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="member">Game Member</label>
                      <input type="number" class="form-control @error('member') is-invalid @enderror" value="{{ isset($game) ? $game->member : '' }}" id="member" name="member" placeholder="Game Member">
                      @error('member')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="board_bg_color">Board Background Color</label>
                      <input type="color" class="form-control @error('board_bg_color') is-invalid @enderror" value="{{ isset($game) ? $game->board_bg_color : '' }}" id="board_bg_color" name="board_bg_color">
                      @error('board_bg_color')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="board_color">Board Color</label>
                      <input type="color" class="form-control @error('board_color') is-invalid @enderror" value="{{ isset($game) ? $game->board_color : '' }}" id="board_color" name="board_color">
                      @error('board_color')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </fieldset>
                    <div class="row">
                      <div class="col-md-6">
                        <fieldset class="form-group">
                          <label for="start_time">Start Time</label>
                          <input type="time" class="form-control @error('start_time') is-invalid @enderror" value="{{ isset($game) ? $game->start_time : '' }}" id="start_time" name="start_time">
                          @error('start_time')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </fieldset>
                      </div>
                      <div class="col-md-6">
                        <fieldset class="form-group">
                          <label for="end_time">End Time</label>
                          <input type="time" class="form-control @error('end_time') is-invalid @enderror" value="{{ isset($game) ? $game->end_time : '' }}" id="end_time" name="end_time">
                          @error('end_time')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </fieldset>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="card-box">
                  <h4 class="header-title">Game Avater</h4>
                  <input type="file" name="game_avater" class="dropify" data-default-file="{{ isset($game) ? asset('games/'. $game->game_avater) : '' }}" data-max-file-size="1M" />
                  <div class="switchery-demo m-t-20">
                    <input {{ isset($game) ? ($game->status == 'on' ? 'checked' : '') : '' }} type="checkbox"
                    data-plugin="switchery" id="status" name="status" data-color="#1bb99a" data-size="small"/>
                    <label class="control-label" for="status">Status</label>
                  </div>
                  <button type="submit" class="btn {{ isset($game) ? 'btn-dark' : 'btn-success' }}">
                      <i class="{{ isset($game) ? 'icon-arrow-up-circle' : 'fa fa-plus-circle' }}"></i>
                      <span>{{ isset($game) ? 'Update' : 'Create' }}</span>
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>



    <!-- end row -->
    </div> <!-- container -->
  </div>
  <!-- content -->
@endsection
@push('page-js')
<!-- Select Js -->
<script src="{{ asset('assets/backend/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/backend/pages/jquery.formadvanced.init.js') }}"></script>
<!-- Switchery -->
<script src="{{ asset('assets/backend/plugins/switchery/switchery.min.js') }}"></script>

<!-- file uploads js -->
<script src="{{ asset('assets/backend/plugins/fileuploads/js/dropify.min.js') }}"></script>
<script>
  $('.dropify').dropify({
      messages: {
          'default': 'Drag and drop a file here or click',
          'replace': 'Drag and drop or click to replace',
          'remove': 'Remove',
          'error': 'Ooops, something wrong appended.'
      },
      error: {
          'fileSize': 'The file size is too big (1M max).'
      }
  });
</script>
@endpush

