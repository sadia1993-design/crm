@extends('layouts.app')
@section('page_title')
    Customer Panel

@endsection

@section('content')

    @if($invoices)
        @foreach($invoices as $invo_recurring)

            @php
                $invo_date =  date("d", strtotime($invo_recurring->date));


            @endphp

            <tr>
                <td>{{$invo_recurring->$invo_date}}</td>
                <td>{{$invo_recurring->interval}}</td>
                <br>
            </tr>


        @endforeach
    @endif

@endsection
