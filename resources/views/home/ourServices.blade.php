@extends('layouts.master')

@section('title', 'Our Services')

@section('content')

      <div class="row">
        <img src="{{ Voyager::image($page['image']) }}" alt="{{ $page['title'] }}" width="100%" />
      </div>

      {!! $page['body'] !!}

      <hr>

      <!-- Call to Action Section -->
      <div class="row mb-4">
        <div class="text-center">
          <p>{{ $page['excerpt'] }}</p>
        </div>
        {{-- <div class="col-md-4">
          <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
        </div> --}}
      </div>

@endsection