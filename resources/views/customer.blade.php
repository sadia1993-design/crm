@extends('layouts.app')
@section('page_title')
    Customer Panel

@endsection

@section('content')

    @php
        $invoices = Helper::getRecurringInvoice();

    @endphp


    @forelse($invoices as $value)

        @php
            $recurringPay = date('Y-m-d', strtotime($value->due_date. ' + '. $value->interval .'days'));
        @endphp


        <div class="alert alert-warning alert-dismissible" role="alert">
            New  recurring invoice <strong>({{$value->invoice_number}})</strong> from due date <strong>({{$value->due_date}})</strong> was created for you!! <br> Pay within
            <strong>{{$recurringPay}}</strong>
            <a href="{{route('invoice.show', $value->invoice_number)}}" style="margin-left: 5px" class="btn btn-sm btn-outline-blue"><i class="fas fa-eye"></i></a>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>

    @empty
    @endforelse

@endsection
