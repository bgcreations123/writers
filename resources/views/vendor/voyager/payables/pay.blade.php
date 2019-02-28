@extends('voyager::master')



@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                To Pay : {{$payable->amount_payable}}
                Owed : {{$TotalMoneyOwed}}
                - checkout -
            </div>
        </div>
    </div>
@stop