@extends('Frontend.layouts.default')



@section('content')

<div class="jumbotron full-bg animated-bg" data-bg="{{ asset('public/Frontend/images/banner.jpg') }}">
    <div class="col-md-6 col-md-offset-3 centered text-center">
        <h1>Meet Talon's Dor</h1>
        <p>Your Personal Shoe Designer</p>
        <p> <a class="btn btn-primary btn-lg" href="#services" role=button><span class="fa-caret-down fa"></span> Start Designing</a> </p>
    </div>
</div>

<div id='services' class="container-fluid separator">
    <div class=row>
        <h2>Select a Shoe</h2>
        @foreach($shoes as $shoe)
        <div class="col-sm-6 col-md-4">
            <div class=thumbnail>
                <img src="{{ $shoe->image }}"> 
                <div class=caption>
                    <h4>{{ $shoe->category }}</h4>
                    <p>{{ $shoe->short_desc }}</p>
                    <a href="/customize/{{$shoe->url_key}}" class="btn btn-primary" role=button><span class="fa-arrow-circle-right fa"></span> Customize</a> 
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div id=team class="container-fluid text-center separator">
    <div class=row>
        <div class=col-md-12>
            <h3>Meet our team</h3>
        </div>
    </div>
    <div class=row>
        <div class=col-md-4>
            <div href="#" class=team-member>
                <img src="images/dummy/team1.jpg" alt=""> 
                <div class=title>
                    <h4>Soraya Doe</h4>
                    <h5>Senior SEO expert</h5>
                </div>
                <div class=caption> <a href="#" class="icon fa fa-twitter"> </a> <a href="#" class="icon fa fa-facebook"> </a> <a href="#" class="icon fa fa-linkedin"> </a> </div>
            </div>
        </div>
        <div class=col-md-4>
            <div href="#" class=team-member>
                <img src="images/dummy/team2.jpg" alt=""> 
                <div class=title>
                    <h4>John Doe</h4>
                    <h5>Chief Executive Officer</h5>
                </div>
                <div class=caption> <a href="#" class="icon fa fa-twitter"> </a> <a href="#" class="icon fa fa-facebook"> </a> <a href="#" class="icon fa fa-instagram"> </a> <a href="#" class="icon fa fa-linkedin"> </a> </div>
            </div>
        </div>
        <div class=col-md-4>
            <div href="#" class=team-member>
                <img src="images/dummy/team3.jpg" alt=""> 
                <div class=title>
                    <h4>Jane Doe</h4>
                    <h5>Marketing Guru</h5>
                </div>
                <div class=caption> <a href="#" class="icon fa fa-twitter"> </a> <a href="#" class="icon fa fa-instagram"> </a> <a href="#" class="icon fa fa-facebook"> </a> </div>
            </div>
        </div>
    </div>
</div>

@stop