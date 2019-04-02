@extends('layouts.master')

@section('title', '')

@section('content')
    <div class="container" style="padding-top: 40px;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10 border border-default rounded p-2">
                <div class="row">
                    <div class="col-md-6 content border-right">
                        {{-- <div class="col-12 mx-auto text-center" style="padding-left: 240px"> --}}
                        <img src="{{ Voyager::image( setting('site.logo') ) }}">

                        <h1 class="text-center">{{ setting('site.title') }}</h1>

                        <p class="text-center">{{ setting('site.description') }}</p>
                    </div>
                    <div class="col-md-6 content my-auto">
                        <div class="card-title">
                          <div class="row justify-content-center align-items-center">
                            <div class="col-10 border-bottom">
                              <h4>Price View Meter</h4>
                            </div>
                            <div class="col-2">
                              <div id="red-circle" class="circle-text float-right">
                                <div id="pricing-plan-price" class="pricing-plan-price inner-text center-align">
                                  <sup><strong>$</strong></sup>0<span>.00</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <form>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="classification">Classification</label>
                              <select id="classification" class="form-control form-control-sm" name="classification">
                                <option value="0" selected>Choose...</option>
                                @foreach($classifications as $classification)
                                  <option value="{{ $classification['id'] }}" {{ (old('classification') == $classification['id']) ? "selected" : "" }}>{{ $classification['classification'] }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="period">Time Period</label>
                              <select id="period" class="form-control form-control-sm" name="period">
                                <option value="0" selected>Choose...</option>
                                @foreach($paperPeriods as $paperPeriod)
                                  <option value="{{ $paperPeriod['id'] }}" {{ (old('period') == $paperPeriod['id']) ? "selected" : "" }}>{{ $paperPeriod['period'] }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <label for="pages">No. of Pages: <span id="pages"></span></label>
                                <div class="slidecontainer">
                                    <input type="range" min="1" max="100" value="1" class="slider" name="pages" id="myRange">
                                </div>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection