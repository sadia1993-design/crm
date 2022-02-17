@extends('layouts.app')
@section('page_title')
    <span>Task {{$id}}</span>
@endsection

@section('content')

    <style>
        .task-single-col-right {
            background-image: linear-gradient(to left bottom, #b6c3d6, #b4c8dc, #b0cce1, #add1e5, #a9d6e8);
            padding: 45px;
        }
        .next i {
            margin-right: 11px;
        }
        .task-single-col-left {
            padding: 45px;
            background: #fff;
        }
        .components ul li {
            margin-bottom: 10px;
        }
        .button-group ul li{
            margin-right: 12px;
        }
        .components ul li i {
            margin-right: 11px;
        }
    </style>

    <div class="container-fluid wrapper">
        <div class="card">
            <div class="card-body" style="padding: 0">
                <div class="row">
                    <div class="col-md-8 task-single-col-left">
                        <div class="button-group" style=" border-bottom: 1px solid #CCCCCC;margin-bottom: 20px ; padding-bottom: 20px;">
                            <ul style="list-style: none;margin: 0;padding: 0" class="d-flex">
                                <li><a href="" title="Mark as Complete" class="btn btn-light-gray"><i class="fas fa-check"></i></a></li>
                                <li><a href="" data-toggle="modal" data-target="#statistics" title="Statistics" class="btn btn-light-gray"><i class="fas fa-chart-bar"></i></a></li>
                                <li><a href=""  title="Timesheets" class="btn btn-light-gray"><i class="fas fa-tasks"></i></a></li>
                                <li><a href=""  class="btn btn-success"><i class="fas fa-clock"></i> START TIMER</a></li>
                            </ul>
                        </div>

                        <!--task subject -->
                        <div class="taskDescription" style=" border-bottom: 1px solid #CCCCCC;margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Subject</h4>
                            <p>{{$singleTasks->subject}}</p>
                        </div>

                        <!--task description -->
                        <div class="taskDescription" style=" margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Task Description</h4>
                            <p>{{$singleTasks->description}}</p>
                        </div>

                    </div>
                    <div class="col-md-4 task-single-col-right">
                        <div class="task-info" style=" border-bottom: 1px solid #9da2dd;margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Task Info</h4>
                            <p>{{$singleTasks->created_at}}</p>
                        </div>

                        <!--components-->
                        <div class="components" style=" border-bottom: 1px solid #9da2dd !important;margin-bottom: 20px ; padding-bottom: 20px;">
                            <ul style="list-style: none;margin: 0;padding: 0" >
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-star"></i>
                                        <span >
                                            <strong>Status:
                                                @if($singleTasks->status == 'pending')
                                                    <span style="color: #ff0000">{{  $singleTasks->status  }}</span>

                                                @elseif($singleTasks->status == 'in_progress')
                                                    <span style="color: green">{{  "In Progress"  }}</span>

                                                @elseif($singleTasks->status == 'testing')
                                                    <span style="color: green">{{  "Testing"  }}</span>

                                                @elseif($singleTasks->status == 'feedback')
                                                    <span style="color: green">{{  "Feedback"  }}</span>

                                                @elseif($singleTasks->status == 'complete')
                                                    <span style="color: green">{{  "Complete"  }}</span>

                                                @endif
                                            </strong>

                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar"></i>
                                        <span > <strong>Start Date:</strong>  {{  $singleTasks->start_date  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar"></i>
                                        <span > <strong>End Date:</strong>  {{  $singleTasks->end_date  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-bolt"></i>
                                        <span > <strong>Priority: </strong> {{  $singleTasks->priority  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar-times"></i>
                                        <span > <strong>Duration:</strong>  {{  $singleTasks->duration  }} </span>
                                    </div>
                                </li>
                            </ul>
                        </div>


                        <div class="next d-flex" style=" border-bottom: 1px solid #9da2dd !important;margin-bottom: 20px ; padding-bottom: 20px;" >
                            <i class="fas fa-user"></i>
                            <span > Assigned To:  {{  $singleTasks->user->name  }}</span>
                        </div>

                        <div class="next d-flex" style=" border-bottom: 1px solid #9da2dd !important;margin-bottom: 20px ; padding-bottom: 20px;">
                            <i class="fas fa-project-diagram"></i>
                            <span > Project Name:  {{  $singleTasks->project->name  }}</span>
                        </div>

                        <div class="next d-flex" >


                            <span > Milestone Info:  {{  $singleTasks->milestones->name  }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="statistics" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(to right,#226faa 0,#2989d8 37%,#72c0d3 100%);">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Task Statistics</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" style="background: linear-gradient(to right,#226faa 0,#2989d8 37%,#72c0d3 100%);" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
