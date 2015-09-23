@extends('Frontend.layouts.default')
@section('content')

<div id='services' class="container-fluid separator">
    <div class="row">
        <h2>Saved Lists</h2>
        <div class="col-md-8">
            <div class="designarea">
                <div class="shoedit">
         @foreach($savedList as $spec)
           <?php
        // dd($savedList);
         $spec = json_decode($spec->product_spec,true);
         ?>
         <ul>
          @foreach($spec as $k=>$sp)
          <li><img src="/construct?angle=1&shoe=Ballet Flats&spec[{{$k}}]={{$sp}}" data-angle="1"  id="d" alt/>{{$k." - ".$sp}}</li>
            @endforeach
        </ul>
         @endforeach
        
    </div>
        <div class="row">
        </div>
</div>
@stop 
