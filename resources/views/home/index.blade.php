@extends('layouts.master')

@section('title', 'Home')

@section('content')

      <!-- Heading Row -->
      <div class="row my-4">
        <div class="col-lg-8">
            <form action="{{ route('order.newOrder') }}" method="post">
              {{ csrf_field() }}
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="classification">Classification</label>
                  <select id="classification" class="form-control" name="classification">
                    <option value="0" selected>Choose...</option>
                    @foreach($classifications as $classification)
                      <option value="{{ $classification['id'] }}" {{ (old('classification') == $classification['id']) ? "selected" : "" }}>{{ $classification['classification'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="period">Time Period</label>
                  <select id="period" class="form-control" name="period" >
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
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck" name="terms">
                  <label class="form-check-label" for="gridCheck">
                    Accept terms and Conditions
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
          <h2 class="text-center">Get your Paper written By A Proffessional Writer</h2>
          <p>Place an order Today and Experience writers with the highest satisfaction rates, Lowest prices on the market, Security, confidentiality, and money back guarantee!</p>
          {{-- <a class="btn btn-primary btn-lg" href="#">Call to Action!</a> --}}
        </div>
        <!-- /.col-md-4 -->
      </div>
      <!-- /.row -->

      <!-- Call to Action Well -->
      <div class="card text-white bg-secondary my-4 text-center">
        <div class="card-body">
          <p class="text-white m-0">
            Technical subjects involving sciences and mathematics are subject to an additional 10% of the indicated prices.
            <br>
            Prices above are for one regular page or 275 words.
          </p>
        </div>
      </div>

      <!-- Content Row -->
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Pending Oders ({{ count($pendingOrders) }})</h2>
              <ul>
                @foreach($pendingOrders as $pendingOrder)
                {{-- {{dd('home.view_order', ['id'=>$pendingOrder->id])}} --}}
                  <li>
                    <a href="{{ route('home.view_order', ['id'=>$pendingOrder->id]) }}">
                      {{ $pendingOrder->subject }}
                    </a> 
                    ({{ \Carbon\Carbon::parse($pendingOrder->deadline)->diffForHumans() }})
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">More Info</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Processing orders ({{ count($processingOrders) }})</h2>
              <ul>
                @foreach($processingOrders as $processingOrder)

                  <li>
                    <a href="{{ route('home.view_order', ['id'=>$processingOrder->id]) }}">
                      {{ $processingOrder->subject }}
                    </a> 
                    {{-- ({{ \Carbon\Carbon::parse($processingOrder->deadline)->diffForHumans() }}) --}}
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">More Info</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Complete Orders ({{ count($completedOrders) }})</h2>
              <ul>
                @foreach($completedOrders as $completedOrder)
                  <li>
                    <a href="{{ route('home.view_order', ['id'=>$completedOrder->id]) }}">
                      {{ $completedOrder->subject }}
                    </a> 
                    ({{ \Carbon\Carbon::parse($completedOrder->updated_at)->diffForHumans() }})
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">More Info</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->

      </div>
      <!-- /.row -->

@endsection