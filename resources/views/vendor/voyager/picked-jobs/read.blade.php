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
       {{-- {{dd($pickedJob)}} --}}
        <div class="card">
            {{-- Begin foreign code --}}
            <div class="row">
                <div class="col-lg-8 col-md-12 my-auto text-center">
                    <h1>{{ $pickedJob['orderDetail']['subject'] }}</h1>
                    <h6>{{ $pickedJob['product']['classification']['classification'] }} Under {{ $pickedJob['product']['period']['period'] }}</h6>
                    <p>{{ $pickedJob['orderDetail']['pages'] }} pages</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="">
                      <div class="card-body text-center">
                        <h5 class="card-title">Deadline</h5>
                    <p class="card-text">
                        {{ \Carbon\Carbon::parse($pickedJob['deadline'])->toDayDateTimeString() }}
                        <br />
                        {{ \Carbon\Carbon::parse($pickedJob['deadline'])->diffForHumans() }}
                    </p>
                      </div>
                    </div>
                </div>
            </div>

{{-- @include('voyager::formfields.link', ['view' => 'browse','options' => $completedJob['orderDetail']['type']['type']]) --}}

            <div class="col-md-12">
                <h3 class="" style="padding-left: 20px;">Job Details</h3>

                <div class="col-lg-6 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">Paper Type : {{ $pickedJob['orderDetail']['type']['type'] }} </li>
                        <li class="list-group-item">Paper Format : {{ $pickedJob['orderDetail']['format']['format'] }}</li>
                        <li class="list-group-item">No. of Sources : {{ $pickedJob['orderDetail']['sources'] }}</li>
                        <li class="list-group-item">Paper Language: {{ $pickedJob['orderDetail']['language']['language'] }}</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">Paper Spacing : {{ $pickedJob['orderDetail']['spacing']['space'] }} </li>
                        <li class="list-group-item">Client Name : {{ $pickedJob['orderDetail']['order']['user']['name'] }}</li>
                        <li class="list-group-item">Job Status : {{ $pickedJob['orderDetail']['orderDetailStatus']['status'] }}</li>
                        <li class="list-group-item">Job Price : $ {{ $pickedJob['product']['job_price'] * $pickedJob['orderDetail']['pages'] }}.00</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">
                <h3 style="padding-left: 20px;">Job Description</h3>
                <p style="padding-left: 20px;">
                    {{ $pickedJob['orderDetail']['description'] }}
                    {{-- {{ route('voyager.'.$dataType->slug.'.review', $dataTypeContent->getKey()) }} --}}
                </p>
            </div>
            <div class="col-lg-6 col-md-3 col-sm-6 mb-4">
                <!-- Related Projects Row -->
                <h3 class="my-4" style="padding-left: 20px;">Related Documents</h3>
              
                <div class="card border-primary col-md-6">
                    <div class="card-body">
                        @if(empty($pickedJob['orderDetail']['files']))
                            <p>No related files. Reffer to job description.</p>
                        @else
                        <h5 class="card-title">File</h5>
                        <p class="card-text">
                            <small>File name:</small>
                            {{ $pickedJob['orderDetail']['files'] }}
                        </p>
                        <a class="btn btn-sm btn-primary mx-auto d-block" href="{{ url( 'download', ['ref', $pickedJob['orderDetail']['files']])  }}">Download</a>
                        @endif
                    </div>
                </div>
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
