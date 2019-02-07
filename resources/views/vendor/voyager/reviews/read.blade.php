@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->display_name_singular) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager::generic.edit') }}
            </a>
        @endcan
        @can('delete', $dataTypeContent)
            <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
            </a>
        @endcan

        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="page-content read container-fluid">
       
        <div class="card">
            {{-- Begin foreign code --}}
            <div class="row">
                <div class="col-lg-8 col-md-12 my-auto text-center">
                    <h1>{{ $review['completedJob']['orderDetail']['subject'] }}</h1>
                    <h6>{{ $review['completedJob']['product']['classification']['classification'] }} Under {{ $review['completedJob']['product']['period']['period'] }}</h6>
                    <p>{{ $review['completedJob']['orderDetail']['pages'] }} pages</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="">
                      <div class="card-body text-center">
                        <h5 class="card-title">Deadline</h5>
                    <p class="card-text">
                      @if($review['completedJob']['orderDetail']['orderDetailStatus']['status'] == 'Complete')
                        {{ \Carbon\Carbon::parse($review['completedJob']['updated_at'])->toDayDateTimeString() }}
                        <br />
                        {{ \Carbon\Carbon::parse($review['completedJob']['updated_at'])->diffForHumans() }}
                      @else
                        {{ \Carbon\Carbon::parse($review['completedJob']['deadline'])->toDayDateTimeString() }}
                        <br />
                        {{ \Carbon\Carbon::parse($review['completedJob']['deadline'])->diffForHumans() }}
                      @endif
                    </p>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3 class="" style="padding-left: 20px;">Job Details</h3>

                <div class="col-lg-6 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">Paper Type : {{ $review['completedJob']['orderDetail']['type']['type'] }} </li>
                        <li class="list-group-item">Paper Format : {{ $review['completedJob']['orderDetail']['format']['format'] }}</li>
                        <li class="list-group-item">No. of Sources : {{ $review['completedJob']['orderDetail']['sources'] }}</li>
                        <li class="list-group-item">Paper Language: {{ $review['completedJob']['orderDetail']['language']['language'] }}</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">Paper Spacing : {{ $review['completedJob']['orderDetail']['spacing']['space'] }} </li>
                        <li class="list-group-item">Client Name : {{ $review['completedJob']['orderDetail']['order']['user']['name'] }}</li>
                        <li class="list-group-item">Job Status : {{ $review['completedJob']['orderDetail']['orderDetailStatus']['status'] }}</li>
                        <li class="list-group-item">Job Price : $ {{ $review['completedJob']['product']['job_price'] * $review['completedJob']['orderDetail']['pages'] }}.00</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">
                <h3 style="padding-left: 20px;">Job Description</h3>
                <p style="padding-left: 20px;">
                    {{ $review['completedJob']['orderDetail']['description'] }}
                    <br />
                    <br />
                </p>
            </div>

            <div class="col-lg-6 col-md-3 col-sm-6 mb-4">
                <!-- Related Projects Row -->
                <h3 class="my-4" style="padding-left: 20px;">Related Documents</h3>
              
                <div class="card border-primary col-md-6">
                    <div class="card-body">
                        @if(empty($completedJob['orderDetail']['files']))
                            <p>No related files. Reffer to job description.</p>
                        @else
                        <h5 class="card-title">File</h5>
                        <p class="card-text">
                            <small>File name:</small>
                            {{ $review['completedJob']['orderDetail']['files'] }}
                        </p>
                        <a class="btn btn-sm btn-primary mx-auto d-block" href="{{ url( 'download', [$review['completedJob']['orderDetail']['files']])  }}">Download</a>
                        @endif
                    </div>
                </div>
            </div>

            
            <div class="col-lg-6 col-md-3 col-sm-6 mb-4">
                <!-- Finished Jobs Row -->
                <h3 class="my-4" style="padding-left: 20px;">Finished Documents</h3>

                <div class="card col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">File</h5>
                        @if(empty($review['completedJob']['files']))
                            <p>Sorry, No Evidence/Proof of work!</p>
                        @else
                            <p class="card-text">
                                <small>File name:</small> 
                                {{ $review['completedJob']['files'] }}
                            </p>
                            <a class="btn btn-sm btn-primary mx-auto d-block" href="{{ url( 'download', [$review['completedJob']['files']])  }}">
                                Download
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 my-4">
            	<a href="{{ URL::previous() }}" class="btn btn-default">back</a>
	            <a href="{{ route('approve', $dataTypeContent->getKey()) }}" class="btn btn-success">Approve</a>
	            <a href="{{ route('reject', $dataTypeContent->getKey()) }}" class="btn btn-danger">Reject</a>
	            {{-- {{ route('review', $dataTypeContent->getKey()) }} --}}
            </div>

        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->display_name_singular) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->display_name_singular) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
