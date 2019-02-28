@extends('layouts.master')

@section('title', 'View')

@section('content')

{{-- {{dd($orderDetails->order_detail_status_id)}} --}}

  <div class="row">

    {{--  --}}
		<div class="col-lg-7 col-md-12 my-auto text-center">
			<h1>{{ $orderDetails->subject }}</h1>
			<h6>{{ $orderDetails->product->classification->classification }} Under {{ $orderDetails->product->period->period }}</h6>
      <p>{{ $orderDetails->pages }} Pages</p>
		</div>

    {{--  --}}
    <div class="col-lg-5 col-md-12">
      <div class="card">
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
              {!! ($orderDetails->deadline < \Carbon\Carbon::now()) ? 'Expired '. \Carbon\Carbon::parse($orderDetails->deadline)->diffForHumans() : \Carbon\Carbon::parse($orderDetails->deadline)->toDayDateTimeString() .'<br>'. \Carbon\Carbon::parse($orderDetails->deadline)->diffForHumans() !!}
            @endif
          </p>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    {{-- Left --}}
    <div class="col-md-7">

      {{--  --}}
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="my-3">
          Job Details
        </h3>
        <span class="pr-2">
          <small>ID:</small> <strong>{{ $orderDetails->uniqueId }}</strong>
        </span>
      </div>
      
      <div class="row">
        <div class="col-md-6 my-2">
        <ul class="list-group">
          <li class="list-group-item">Paper Type : {{ $orderDetails->type->type }} </li>
          <li class="list-group-item">Paper Format : {{ $orderDetails->format->format }}</li>
          <li class="list-group-item">No. of Sources : {{ $orderDetails->sources }}</li>
          <li class="list-group-item">Paper Language: {{ $orderDetails->language->language }}</li>
        </ul>
        </div>
        <div class="col-md-6 my-2">
        <ul class="list-group">
          <li class="list-group-item">Paper Spacing : {{ $orderDetails->spacing->space }} </li>
          <li class="list-group-item">Writter's Name : {{ ($orderDetails->orderDetailStatus->status == 'Complete') ? $completed['writer']['name'] : (($orderDetails->orderDetailStatus->status == 'Processing') ? $processing['writer']['name'] : 'Pending')}}</li>
          <li class="list-group-item">Job Status : {{ $orderDetails->orderDetailStatus->status }}</li>
          <li class="list-group-item">Job Price : $ {{ $orderDetails->product->price * $orderDetails->pages }}.00</li>
        </ul>
        </div>
      </div>

      {{--  --}}
      <div class="row">
        <div class="col-lg-6 col-md-3 col-sm-6 mb-4">

          <!-- Related Projects Row -->
          <h3 class="my-4">Related Documents</h3>

          <div class="card col-md-6">
            <div class="card-body">
              @if(empty($orderDetails->files))
                <p>No related files submited.</p>
              @else
                <h5 class="card-title">File</h5>
                <p class="card-text">
                  <small>File name:</small>
                  {{ '.'.substr(strrchr($orderDetails->files, "."), 1) }}
                </p>
                <a class="btn btn-sm btn-primary mx-auto" href="{{ url( 'download', [$orderDetails->files])  }}">Download</a>
              @endif
            </div>
          </div>
        </div>

        @if($orderDetails->orderDetailStatus->status == 'Complete')
          <div class="col-lg-6 col-md-3 col-sm-6 mb-4">

            <!-- Finished Jobs Row -->
            <h3 class="my-4">Finished Documents</h3>

            <div class="card col-md-6">
              <div class="card-body">
                <h5 class="card-title">File</h5>
                @if(empty($completed->files))
                  <p>Sorry, No Evidence/Proof of work!</p>
                @else
                  <p class="card-text">
                    <small>File Ext:</small> 
                    {{ '.'.substr(strrchr($completed->files, "."), 1) }}
                  </p>
                  <a class="btn btn-sm btn-primary mx-auto" href="{{ url( 'download', [$completed->files])  }}">
                    Download
                  </a>
                @endif
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>

    {{-- Right --}}
    <div class="col-md-5">

      {{--  --}}
      <div class="col-md-12">
        <h3 class="my-3 text-center">Job Description</h3>
        <p>{{ $orderDetails->description }}</p>
        <a href="{{ URL::previous() }}" class="btn btn-outline-secondary float-right">back</a>
        @if($orderDetails->orderDetailStatus->status != 'Pending')
          <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#composeModal">Compose Message</a>
        @endif
      </div>

    </div>
	</div>

  <!-- Modal -->
  <div class="modal fade" id="composeModal" tabindex="-1" role="dialog" aria-labelledby="composeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ route('messages.store') }}" method="POST">
            {{ csrf_field() }}
              <div class="modal-header">
                <h5 class="modal-title" id="composeModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  @if($orderDetails->orderDetailStatus->status == 'Complete')
                    <input type="hidden" class="form-control" id="recipient" name="recipient" value="{{ $completed['writer_id'] }}">
                  @elseif($orderDetails->orderDetailStatus->status == 'Processing')
                    <input type="hidden" class="form-control" id="recipient" name="recipient" value="{{ $processing['writer_id'] }}">
                  @else
                    'Do Nothing!'
                  @endif
                  <label for="recipient">Recipient</label>
                  @if($orderDetails->orderDetailStatus->status == 'Complete')
                    <input type="text" class="form-control" id="recipient" name="recipient" value="{{ $completed['writer']['name'] }}" disabled>
                  @elseif($orderDetails->orderDetailStatus->status == 'Processing')
                    <input type="text" class="form-control" id="recipient" name="recipient" value="{{ $processing['writer']['name'] }}" disabled>
                  @else
                    'Do Nothing!'
                  @endif
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
                  <input type="file" class="form-control" id="message-file" name="file">
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

@endsection