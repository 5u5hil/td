@extends('Frontend.layouts.default')



@section('content')


<div id='services' class="container-fluid separator">
    <div class=row>
        <h2>Please Login ...</h2>
        <div class="col-sm-2">
            <a href="{{ url('login/facebook') }}"><i class="fa fa-facebook"></i></a>
        </div>
        <div class="col-sm-2">
            <a href="{{ url('login/twitter') }}"><i class="fa fa-twitter"></i></a>
        </div>
        <div class="col-sm-2">
            <a href="{{ url('login/google') }}"><i class="fa fa-google"></i></a>
        </div>
        <div class="col-sm-2">
            <a href="{{ url('login/linkedin') }}"><i class="fa fa-linkedin"></i></a>
        </div>        
    </div>
</div>

@stop