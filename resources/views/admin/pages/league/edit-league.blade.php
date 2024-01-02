@extends('admin.template.app')
@push('title')
    Add League || Football Portal
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
                            <li class="breadcrumb-item">Add Leauge</li>
                            
                        </ol>
                    </div>
                    <h4 class="page-title">Edit League Info</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- "All Leagues" Button -->
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('league.all') }}" class="btn btn-secondary">All Leagues</a>
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
                            <form action="{{route('league.update',['uuid' => $leagueinfo->uuid])}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">League Name</label>
                                        <input type="text" value="{{$leagueinfo->name}}"  name="league_name" {{old('league_name')}} class="form-control" data-provide="typeahead" id="the-basics"
                                            placeholder="Enter League Name">
                                    </div>
                                </div> <!-- end col -->
                          
                                <div class="col-lg-12 mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                     
                                        <select name="league_country" class="selectpicker form-control" data-live-search="true">
                                          
                                            <option style="padding: 5px" value="{{$leagueinfo->league_country}}" data-tokens="{{$leagueinfo->league_country}}">{{$leagueinfo->country_name}}</option>
                                            @foreach ($countries as $country)
                                            <option style="padding: 20px 5px" value="{{$country->id}}" data-tokens="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                      
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 mt-3 mt-lg-0 text-center">
                                    <img src="{{asset('storage/uploads/league_flag/'.$leagueinfo->league_flag)}}" alt="{{$leagueinfo->league_flag}}" class="text-center"  id="preview">
                                </div>
                            
                                <div class="col-lg-12 mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label class="form-label">League Flag</label>
                                        <input id="bloodhound" name="league_flag" class="form-control" type="file" accept="image/*" onchange="previewImage(event)">
                                    </div>
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
