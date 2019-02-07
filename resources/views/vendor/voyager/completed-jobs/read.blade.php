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
       {{-- {{dd('voyager.'.$dataType->slug.'.review', $dataTypeContent->getKey())}} --}}
        <div class="card">
            {{-- Begin foreign code --}}
            <div class="row">
                <div class="col-lg-8 col-md-12 my-auto text-center">
                    <h1>{{ $completedJob['orderDetail']['subject'] }}</h1>
                    <h6>{{ $completedJob['product']['classification']['classification'] }} Under {{ $completedJob['product']['period']['period'] }}</h6>
                    <p>{{ $completedJob['orderDetail']['pages'] }} pages</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="">
                      <div class="card-body text-center">
                        <h5 class="card-title">Deadline</h5>
                    <p class="card-text">
                      @if($completedJob['orderDetail']['orderDetailStatus']['status'] == 'Complete')
                        {{ \Carbon\Carbon::parse($completedJob['updated_at'])->toDayDateTimeString() }}
                        <br />
                        {{ \Carbon\Carbon::parse($completedJob['updated_at'])->diffForHumans() }}
                      @else
                        {{ \Carbon\Carbon::parse($completedJob['deadline'])->toDayDateTimeString() }}
                        <br />
                        {{ \Carbon\Carbon::parse($completedJob['deadline'])->diffForHumans() }}
                      @endif
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
                        <li class="list-group-item">Paper Type : {{ $completedJob['orderDetail']['type']['type'] }} </li>
                        <li class="list-group-item">Paper Format : {{ $completedJob['orderDetail']['format']['format'] }}</li>
                        <li class="list-group-item">No. of Sources : {{ $completedJob['orderDetail']['sources'] }}</li>
                        <li class="list-group-item">Paper Language: {{ $completedJob['orderDetail']['language']['language'] }}</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">Paper Spacing : {{ $completedJob['orderDetail']['spacing']['space'] }} </li>
                        <li class="list-group-item">Client Name : {{ $completedJob['orderDetail']['order']['user']['name'] }}</li>
                        <li class="list-group-item">Job Status : {{ $completedJob['orderDetail']['orderDetailStatus']['status'] }}</li>
                        <li class="list-group-item">Job Price : $ {{ $completedJob['product']['job_price'] * $completedJob['orderDetail']['pages'] }}.00</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">
                <h3 style="padding-left: 20px;">Job Description</h3>
                <p style="padding-left: 20px;">
                    {{ $completedJob['orderDetail']['description'] }}
                    <br />
                    <br />
                    <a href="{{ URL::previous() }}" class="btn btn-default">back</a>
                    <a href="{{ route('review', $dataTypeContent->getKey()) }}" class="btn btn-primary">Review</a>
                    {{-- {{ route('voyager.'.$dataType->slug.'.review', $dataTypeContent->getKey()) }} --}}
                </p>
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
