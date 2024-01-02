@extends('admin.template.app')
@push('title')
   EPL Fixtures || Football Portal
@endpush

@section('main-content')
   
   
        //print_r($data['response']['venue']['name']);
        foreach ($data['response'] as $key => $values) {
           //echo'Venue Name '. $values['fixture']['venue']['name']. '<br>';
           // Date: $values['fixture']['date']
           // Referee: $values['fixture']['referee']
           //echo'League '. $values['league']['name'];
           //echo 'Home Team: '. $values['teams']['home']['name'] .'<br>';
           //echo 'Away Team: '. $values['teams']['away']['name'] .'<br>';
           //Home Team Goals : $values['$values']['home']
           //Away Team Goal: $values['$values']['away']
          // print_r($values);
        }

        @foreach ($data['response'] as $key => $values)
            
        @endforeach
        
        
 
@endsection