@extends('layouts.master')

@section('title', 'Home')

@section('content')

      <!-- Heading Row -->
      <div class="row justify-content-center">
        <h1>Welcome to Elect Writers</h1>
      </div>
      <div class="row">
        <div class="col-lg-8 my-4">
          <div class="card border border-default p-4">
            <div class="card-title">
              <div class="row justify-content-center align-items-center">
                <div class="col-10 border-bottom">
                  <h4>Make An Order Today</h4>
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
            <form action="{{ route('order.newOrder') }}" method="post">
              {{ csrf_field() }}
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="classification">Classification</label>
                  <select id="classification" class="form-control form-control-sm" name="classification">
                    <option value="0" selected>Choose...</option>
                    @foreach($classifications as $classification)
                      <option value="{{ $classification['id'] }}" {{ (old('classification') == $classification['id']) ? "selected" : "" }}>{{ $classification['classification'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="period">Time Period</label>
                  <select id="period" class="form-control form-control-sm" name="period">
                    <option value="0" selected>Choose...</option>
                    @foreach($paperPeriods as $paperPeriod)
                      <option value="{{ $paperPeriod['id'] }}" {{ (old('period') == $paperPeriod['id']) ? "selected" : "" }}>{{ $paperPeriod['period'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="pages">No. of Pages: <span id="pages"></span></label>
                  <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="1" class="slider" name="pages" id="myRange">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="terms">
                    <label class="form-check-label" for="gridCheck">
                      Accept terms and Conditions
                    </label>
                  </div>
                </div>
                <div class="col-md-6 text-right">
                  <button type="submit" class="btn btn-primary">Order</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4 my-4">
          <h2 class="text-center">Get your Paper written By A Proffessional Writer</h2>
          <p>Place an order Today and Experience writers with the highest satisfaction rates, Lowest prices on the market, Security, confidentiality, and money back guarantee!</p>
          {{-- <a class="btn btn-primary btn-sm" href="#">Call to Action!</a> --}}
        </div> <!-- /.col-md-4 -->
      </div> <!-- /.row -->

      <!-- Call to Action Well -->
      {{-- <div class="card text-white bg-secondary mb-4 text-center">
        <div class="card-body">
          <p class="text-white m-0">
            Technical subjects involving sciences and mathematics are subject to an additional 10% of the indicated prices.
            <br>
            Prices above are for one regular page or 275 words.
          </p>
        </div>
      </div> --}}

      <h2>My Stats</h2>

      <hr />

      <!-- Content Row -->
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex justify-content-between align-items-center">
                <h5 class="text-primary">
                  Pending orders
                </h5>
                <span class="badge badge-info text-light">
                  {{ count($pendingOrders) }}
                </span>
              </div>
              @if($pendingOrders->isEmpty())
                <p>Apply Your Writting Now...</p>
              @else
                <ul class="list-group  list-group-flush">
                  @foreach($pendingOrders as $pendingOrder)
                    {{-- {{dd('home.view_order', ['id'=>$pendingOrder->id])}} --}}
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <a href="{{ route('home.view_order', ['id'=>$pendingOrder->id]) }}">
                        {{ $pendingOrder->subject }}
                      </a> 
                      <span>
                        {!! ($pendingOrder->deadline < \Carbon\Carbon::now()) ? '<span class="text-danger">Expired</span> '. \Carbon\Carbon::parse($pendingOrder->deadline)->diffForHumans() : \Carbon\Carbon::parse($pendingOrder->deadline)->diffForHumans() !!}
                      </span>
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary btn-sm">More Info</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex justify-content-between align-items-center">
                <h5 class="text-primary">
                  Processing orders
                </h5>
                <span class="badge badge-info text-light">
                  {{ count($processingOrders) }}
                </span>
              </div>
              @if($processingOrders->isEmpty())
                <p>No Orders Processing...</p>
              @else
                <ul class="list-group  list-group-flush">
                  @foreach($processingOrders as $processingOrder)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <a href="{{ route('home.view_order', ['id'=>$processingOrder->id]) }}">
                        {{ $processingOrder->subject }}
                      </a> 
                      {{-- ({{ \Carbon\Carbon::parse($processingOrder->deadline)->diffForHumans() }}) --}}
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary btn-sm">More Info</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="card-title d-flex justify-content-between align-items-center">
                <h5 class="text-primary">
                  Completed orders
                </h5>
                <span class="badge badge-info text-light">
                  {{ count($completedOrders) }}
                </span>
              </div>
              @if($completedOrders->isEmpty())
                <p>No Complete Orders...</p>
              @else
                <ul class="list-group  list-group-flush">
                  @foreach($completedOrders as $completedOrder)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <a href="{{ route('home.view_order', ['id'=>$completedOrder->id]) }}">
                        {{ $completedOrder->subject }}
                      </a> 
                      <span>
                        {{ \Carbon\Carbon::parse($completedOrder->updated_at)->diffForHumans() }}
                      </span>
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary btn-sm">More Info</a>
            </div>
          </div>
        </div> <!-- /.col-md-4 -->
      </div> <!-- /.row -->

      <div class="jumbotron jumbotron-muted">
        <div class="row">
          <div class="col-lg-6">
            <h2>Everything you need to know about the art of Writing. Free!</h2>
            <p class="lead">Subscribe here in below and start learning<br>we are ready for you!</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Enter your email">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">Subscribe</button>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <img src="{{ URL('images/notes5.jpg') }}" class="mx-auto d-block img-thumbnail" style="opacity: 0.7;">
          </div>
        </div> {{-- / . row --}}
      </div> {{-- jumbotron --}}

@endsection