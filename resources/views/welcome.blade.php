@extends('layouts.master')

@section('content')
    <div class="container" style="padding-top: 40px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="content">
                    <div class="col-12 mx-auto text-center" style="padding-left: 240px">
                        <img src="{{ Voyager::image( setting('site.logo') ) }}">
                    </div>

                    <h1 class="text-center">{{ setting('site.title') }}</h1>

                    <p class="text-center">{{ setting('site.description') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection