



@extends('includes.master')

@section('css_links')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

@section('content')

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

</style>

                      <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="book" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$total_project}}</h2>
                                    <p class="card-text">Projects</p>
                                </div>
                                <div id="line-area-chart-1"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-success p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$total_empolyee}}</h2>
                                    <p class="card-text">Empolyee</p>
                                </div>
                                <div id="line-area-chart-2"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="user-plus" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$total_clients}}</h2>
                                    <p class="card-text">Clients</p>
                                </div>
                                <div id="line-area-chart-3"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            
                                          <i class="fas fa-tasks" style="font-size: 20px;" class="font-medium-5" ></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$total_task}}</h2>
                                    <p class="card-text">Tasks</p>
                                </div>
                                <div id="line-area-chart-4"></div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$task_pending}}</h2>
                                    <p class="card-text">Pending</p>
                                </div>
                                <div id="line-area-chart-1"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-success p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fas fa-spinner" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$task_progress}}</h2>
                                    <p class="card-text">Progress</p>
                                </div>
                                <div id="line-area-chart-2"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="shopping-cart" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$task_completed}}</h2>
                                    <p class="card-text">Completed</p>
                                </div>
                                <div id="line-area-chart-3"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fas fa-vote-nay" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$task_rejected}}</h2>
                                    <p class="card-text">Rejected</p>
                                </div>
                                <div id="line-area-chart-4"></div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fas fa-thumbs-up" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$Admin_Approval}}</h2>
                                    <p class="card-text">Admin Approval</p>
                                </div>
                                <div id="line-area-chart-1"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-success p-50 m-0">
                                        <div class="avatar-content">
                                            
                                            <i class="fas fa-pause" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{$task_Pause}}</h2>
                                    <p class="card-text">Pause</p>
                                </div>
                                <div id="line-area-chart-2"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="shopping-cart" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">36%</h2>
                                    <p class="card-text">Quarterly Sales</p>
                                </div>
                                <div id="line-area-chart-3"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="package" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">97.5K</h2>
                                    <p class="card-text">Orders Received</p>
                                </div>
                                <div id="line-area-chart-4"></div>
                            </div>
                        </div>
                      </div>










<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>



@stop

@section('js_link')