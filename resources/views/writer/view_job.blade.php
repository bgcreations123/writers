@extends('layouts.writer_master')

@section('title', $orderDetails->subject)

@section('content')

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ $orderDetails->subject }}</h1>
      <span class="float-right my-auto text-center">
         {{ $orderDetails->pages }} Pages
        | {{ $orderDetails->product->classification->classification }} Under {{ $orderDetails->product->period->period }}
      </span>
    </div>

    {{-- {{dd($orderDetails->order_detail_status_id)}} --}}


    <div class="row">
      {{-- Left --}}
      <div class="col-md-12">

      {{-- Right --}}
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12 py-3">
            <a href="{{ URL::previous() }}" class="btn btn-outline-secondary float-right">back</a>
            @if($orderDetails->orderDetailStatus->status == 'Pending')
              @if($orderDetails->deadline <= \Carbon\Carbon::now())
                <a class="btn btn-outline-secondary float-right " href="#">Pay here</a>
              @else
                <a href="{{ route('writer.pick', ['id'=>$orderDetails->id]) }}" class="btn btn-primary float-right">Pick</a>
              @endif
            @elseif($orderDetails->OrderDetailStatus->status == 'Processing')
              @if($processing['writer_id'] != Auth()->user()->id)
                <a class="btn btn-outline-secondary" href="#">Pay here</a>
              @else
                <a href="{{ route('writer.complete', ['id'=>$orderDetails->id]) }}" class="btn btn-success">Complete</a>
                <a href="{{ route('writer.deffer', ['id'=>$orderDetails->id]) }}" class="btn btn-outline-danger ">Defer</a>
              @endif
              <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#composeModal">Compose Message</a>
            @endif
          </div>
        </div>
      </div>

        <div class="card shadow">
          <div class="card-body text-center">
            @if($orderDetails->orderDetailStatus->status == 'Complete')
              <h5 class="card-title">Completed</h5>
            @else
              @if($orderDetails->deadline <= \Carbon\Carbon::now())
                <h5 class="card-title text-danger">Expired</h5>
              @else
                <h5 class="card-title">Deadline</h5>
              @endif
            @endif
            <p class="card-text">
              @if($orderDetails->orderDetailStatus->status == 'Complete')
                {{ \Carbon\Carbon::parse($orderDetails->updated_at)->toDayDateTimeString() }} (GMT)
                <br />
                {{ \Carbon\Carbon::parse($orderDetails->updated_at)->diffForHumans() }}
              @else
                {{ \Carbon\Carbon::parse($orderDetails->deadline)->toDayDateTimeString() }} (GMT)
                <br />
                {{ \Carbon\Carbon::parse($orderDetails->deadline)->diffForHumans() }}
              @endif
            </p>
          </div>
        </div>

        {{--  --}}
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="my-3">
            Job Details
          </h4>
          <span class="pr-2">
            <small>ID:</small> <strong>{{ $orderDetails->uniqueId }}</strong>
          </span>
        </div>
        
        <div class="row">
          <div class="col-md-6 my-2">
            <ul class="list-group">
              <li class="list-group-item">Paper Type : {{ empty($orderDetails->type->type)?'Any':$orderDetails->type->type }} </li>
              <li class="list-group-item">Paper Format : {{ empty($orderDetails->format->format)?'Any':$orderDetails->format->format }}</li>
              <li class="list-group-item">No. of Sources : {{ empty($orderDetails->sources)?'Any':$orderDetails->sources }}</li>
              <li class="list-group-item">Paper Language: {{ empty($orderDetails->language->language)?'Any':$orderDetails->language->language }}</li>
            </ul>
          </div>
          <div class="col-md-6 my-2">
            <ul class="list-group">
              <li class="list-group-item">Paper Spacing : {{ empty($orderDetails->spacing->space)?'Any':$orderDetails->spacing->space }} </li>
              <li class="list-group-item">Client Name : {{ substr($orderDetails->order->client->name, 0, 1).'. '.str_word_count($orderDetails->order->client->name, 1)[1] }}</li>
              <li class="list-group-item">Job Status : {{ $orderDetails->orderDetailStatus->status }}</li>
              <li class="list-group-item">Job Price : $ {{ $orderDetails->product->job_price * $orderDetails->pages }}.00</li>
            </ul>
          </div>
        </div>

        <div class="col-md-12">
          {{--  --}}
          <h4 class="my-3 text-center">Job Description</h4>
          <p>{{ $orderDetails->description }}</p>

          {{-- correction comments if available --}}
        </div>

        {{--  --}}
        <div class="row">
          <div class="col-lg-6 col-md-3 col-sm-6 mb-4">

            <!-- Related Projects Row -->
            <h4 class="my-4">Related Documents</h4>

            <div class="card shadow">
              <div class="card-body">
                @if(empty($orderDetails->files))
                  <p>No related files submited.</p>
                @else
                  <div class="card-deck">
                    <div class="card col-md-6 shadow">
                      <div class="card-block text-center">
                        <h4 class="card-title text">
                          <small>
                            <a href="{{ url( 'download', ['ref', $orderDetails->files])  }}">Download</a>
                          </small> 
                        </h4>
                        <p class="card-text">
                          <small class="text-muted">
                            <div>
                              <a href="{{ url( 'download', ['ref', $orderDetails->files])  }}">
                                <span class="fa fa-file-o" style="font-size: 20px;"></span>
                                <br>
                                <small>{{ $orderDetails->files }}</small>
                              </a>
                            </div>
                          </small>
                        </p>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>

          @if($orderDetails->orderDetailStatus->status == 'Complete')
            <div class="col-lg-6 col-md-3 col-sm-6 mb-4">
              <!-- Finished Jobs Row -->
              <h4 class="my-4">Finished Documents</h4>
              <div class="card shadow">
                <div class="card-body">
                  @if(empty($files))
                    <p>Sorry, No Evidence/Proof of work!</p>
                  @else
                    <div class="card-deck">
                      @foreach($files as $file)
                        <div class="card col-md-6">
                          <div class="card-block text-center">
                            <h4 class="card-title text">
                              <small>
                                <a href="{{ url( 'download', ['job', $file->name])  }}">Download</a>
                              </small> 
                            </h4>
                            <p class="card-text">
                              <small class="text-muted">
                                <div>
                                  <a href="{{ url( 'download', ['job', $file->name])  }}">
                                    <span class="fa fa-file-o" style="font-size: 20px;"></span>
                                    <br>
                                    <small>{{ $file->name }}</small>
                                  </a>
                                </div>
                              </small>
                            </p>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <!-- <div class="col-md-2">
                        <a class="btn btn-sm btn-primary mx-auto" href="{{ url( 'download', ['job', $completed->files])  }}">
                          Download
                        </a>
                      <a href="{{ url( 'download', ['job', $completed->files])  }}">
                        <span class="fa fa-file-o" style="font-size: 60px;"></span>
                        <br>
                        {{ '.'.substr(strrchr($file->name, "."), 1) }}
                      </a>
                    </div> -->
                  @endif
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="composeModal" tabindex="-1" role="dialog" aria-labelledby="composeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
              <div class="modal-header">
                <h5 class="modal-title" id="composeModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="recipient" name="recipient" value="{{ $orderDetails->order->user_id }}">
                    <label for="recipient">Recipient</label>
                    <input type="text" class="form-control" id="recipient" name="recipient" value="{{ $orderDetails->order->client->name  }}" disabled>
                </div>
                <div class="form-group">
                  <label for="subject" class="col-form-label">Subject:</label>
                  <input type="text" class="form-control" id="subject" name="subject">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Message:</label>
                  <textarea class="form-control" id="message-text" name="message"></textarea>
                </div>
                <div class="form-group">
                  <label for="message-file" class="col-form-label">Attachment:</label>
                  <input type="file" class="form-control" id="message-file" name="file[]" multiple>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="send">Send Message</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </main>

@endsection