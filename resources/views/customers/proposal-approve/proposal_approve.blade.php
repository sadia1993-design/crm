@extends('layouts.app')
@section('page_title')
  View All Proposals
@endsection
@section('content')
{{-- Table starts from here --}}
<div class="container-fluid wrapper">
    <table class="table table-bordered table-hover display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th class="col-md-2">Customer Name</th>
                <th class="col-md-2">Subject</th>
                <th class="col-md-2">Date</th>
                <th class="col-md-2">Due Date</th>
                <th class="col-md-2">Status</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($proposals as $proposal)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$proposal->customers->user->name}}</td>
                <td>{{$proposal->subject}}</td>
                <td>{{$proposal->date}}</td>
                <td>{{$proposal->due_date}}</td>
                <td>
                    @if ($proposal->status == 'sent')
                        <span class=" badge badge-secondary text-white font-weight-bold">{{$proposal->status}}</span>
                        @elseif ($proposal->status == 'accepted')
                        <span class="badge badge-success text-red font-weight-bold">{{$proposal->status}}</span>
                        @elseif ($proposal->status == 'rejected')
                        <span class="badge badge-warning text-dark font-weight-bold">{{$proposal->status}}</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('proposals.show',$proposal->id)}}" class="btn btn-sm btn-blue">View</a>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>
{{-- Table ends here --}}


@endsection
