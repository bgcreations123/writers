@extends('layouts.master')

@section('content')
    <div class="container" style="padding-top: 40px;">
        <div class="row justify-content-center align-items-center">
                <div class="content border border-default rounded">
                    {{-- <div class="col-12 mx-auto text-center" style="padding-left: 240px"> --}}
                    <img src="{{ Voyager::image( setting('site.logo') ) }}">

                    <h1 class="text-center">{{ setting('site.title') }}</h1>

                    <p class="text-center">{{ setting('site.description') }}</p>
                </div>
        </div>
    </div>
@endsection