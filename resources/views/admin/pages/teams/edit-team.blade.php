@extends('admin.template.app')
@push('title')
   Edit Team || Football Portal
@endpush
@push('select2')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        function previewImage(event) {
           var input = event.target;
           var image = document.getElementById('preview');
           if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                 image.src = e.target.result;
              }
              reader.readAsDataURL(input.files[0]);
           }
        }
     </script>
     <style>
        #preview {
           width: 300px;
           height: 300px;
        }
     </style>

@endpush

@section('main-content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item">Edit Team</li>
                            
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Team Info</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- "All Leagues" Button -->
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('team.all') }}" class="btn btn-secondary">All Team</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    @if (session('league-success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       {{session('league-success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif

                 
                    <div class="card-header">
                        <h4 class="header-title">Typeahead</h4>
                        <p class="text-muted mb-0">
                            This is the league add form
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{route('team.update',['id' => $teaminfo->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-lg-12 mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label class="form-label">League Name</label>
                                    
                                        @if(count($leagues) > 0)
                                        <select name="league_name" class="selectpicker form-control" data-live-search="true">
                                            @foreach ($leagues as $league)
                                            <option value="{{ $league->id }}" data-tokens="{{ $league->name }}">
                                                {{ $league->name }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select class="selectpicker form-control" data-live-search="true">
                                            <option data-tokens="">No League Found</option>
                                        </select>
                                        @endif
                                     
                                    </div>
                                    @error('league_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Team Name</label>
                                        <input type="text" value="{{$teaminfo->team_name}}" name="team_name" class="form-control" data-provide="typeahead" id="the-basics"
                                            placeholder="Enter Team Name">
                                    </div>
                                    @error('team_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> <!-- end col -->
                           
                                <div class="col-lg-12 mt-3 mt-lg-0 text-center">
                                    <img src="{{asset('storage/uploads/team_flag/'.$teaminfo->team_flag)}}" alt="{{$teaminfo->team_flag}}" class="text-center" alt="" id="preview">
                                </div>
                            
                                <div class="col-lg-12 mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label class="form-label">Team Flag</label>
                                        <input id="bloodhound" name="team_flag" class="form-control" type="file" accept="image/*" onchange="previewImage(event)">
                                    </div>
                                    @error('team_flag')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Team Founded</label>
                                        <input type="text" value="{{$teaminfo->founded}}"  name="founded" class="form-control" data-provide="typeahead" id="the-basics"
                                            placeholder="Enter Team Estabilish Year">
                                    </div>
                                    @error('founded')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> 

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Is Currently League Playing Team?</label>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_currently_playing" id="currentlyPlayingNo" value="0"
                                                   @if($teaminfo->is_top_team === 0) checked @endif>
                                            <label class="form-check-label" for="currentlyPlayingNo">
                                                No
                                            </label>
                                        </div>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_currently_playing" id="currentlyPlayingYes" value="1"
                                                   @if($teaminfo->is_top_team === 1) checked @endif>
                                            <label class="form-check-label" for="currentlyPlayingYes">
                                                Yes
                                            </label>
                                        </div>
                                        
                                    </div>
                                    @error('is_currently_playing')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            
                                <div class="col-lg-12 mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-info" type="submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
