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
        .task-single-col-left {
            padding: 45px;
            background: #fff;
        }
        .button-group ul li{
            margin-right: 12px;
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
                                <li><a href="" title="Statistics" class="btn btn-light-gray"><i class="fas fa-chart-bar"></i></a></li>
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
                        <div class="taskDescription" style=" border-bottom: 1px solid #CCCCCC;margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Task Description</h4>
                            <p>{{$singleTasks->description}}</p>
                        </div>

                    </div>
                    <div class="col-md-4 task-single-col-right">
                        <div class="task-info" style=" border-bottom: 1px solid #ffffff;margin-bottom: 20px ; padding-bottom: 20px;">
                            <h4>Task Info</h4>
                            <p>{{$singleTasks->created_at}}</p>
                        </div>

                        <!--components-->
                        <div class="components">
                            <ul style="list-style: none;margin: 0;padding: 0" >
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-star"></i>
                                        <span > Status:  {{  $singleTasks->status  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar"></i>
                                        <span > Start Date:  {{  $singleTasks->start_date  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-calendar"></i>
                                        <span > Due Date:  {{  $singleTasks->due_date  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-priority"></i>
                                        <span > Priority:  {{  $singleTasks->priority  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-priority"></i>
                                        <span > Duration:  {{  $singleTasks->duration  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-priority"></i>
                                        <span > Assigned To:  {{  $singleTasks->user->name  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-priority"></i>
                                        <span > Project No:  {{  $singleTasks->project->name  }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class="fas fa-priority"></i>
                                        <span > Milestone Count:  {{  $singleTasks->milestones->name  }}</span>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
