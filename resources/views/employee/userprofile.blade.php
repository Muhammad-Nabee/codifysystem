@extends('includes.master1')

@section('css_link')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
    .profile-header .profile-img-container {
    position: absolute;
    bottom: -3rem;
    left: 2.14rem;
    z-index: 2;
}
.navbar-expand-md{
    margin-left: 220px !important;
}
nav .edit-btn{
    margin-left: 530px;
}
</style>



@section('content')


    <!-- BEGIN: Content-->
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li>
                                    <li class="breadcrumb-item active">Profile
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div id="user-profile">
                    <!-- profile header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card profile-header mb-2">
                                <!-- profile cover photo -->
                                <img class="card-img-top" src="{{asset('public/app-assets/images/profile/user-uploads/timeline.jpg')}}" alt="User Profile Image" />
                                <!--/ profile cover photo -->

                                <div class="position-relative">
                                    <!-- profile picture -->
                                    <div class="profile-img-container d-flex align-items-center">
                                        <div class="profile-img">
                                            @if($data->image==null)
                                            <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-11.jpg')}}" class="rounded img-fluid" alt="Card image" />
                                            @elseif($data->image!=null)
                                            <img src="{{asset('public/userprofile/' .$data->image)}}" class="rounded img-fluid" style="width: 120px; height: 120px;" alt="Card image" />
                                            @endif
                                        </div>
                                        <!-- profile title -->
                                        <div class="profile-title ml-3">
                                            <h2 class="text-white">Kitty Allanson</h2>
                                            <p class="text-white">UI/UX Designer</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- tabs pill -->
                                <div class="profile-header-nav">
                                    <!-- navbar -->
                                    <nav class="navbar navbar-expand-md navbar-light ">
                                        <button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <i data-feather="align-justify" class="font-medium-5"></i>
                                        </button>

                                        <!-- collapse  -->
                                        <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
                                            <div class="profile-tabs  d-flex text-center flex-wrap mt-1 mt-md-0">
                                                <ul class="nav nav-pills mb-0">
                                                    <li class="nav-item">
                                                        <a class="nav-link font-weight-bold active" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">Feed</span>
                                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link font-weight-bold" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">About</span>
                                                            <i data-feather="info" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link font-weight-bold" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">Photos</span>
                                                            <i data-feather="image" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                        <a class="nav-link font-weight-bold" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">Friends</span>
                                                            <i data-feather="users" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- edit button -->
                                                <button class="btn btn-primary edit-btn">
                                                    <i data-feather="edit" class="d-block d-md-none"></i>
                                                    <span class="font-weight-bold d-none d-md-block">Edit</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!--/ collapse  -->
                                    </nav>
                                    <!--/ navbar -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ profile header -->

                    <!-- profile info section -->
                    <section id="profile-info">
                        <div class="row">
                            <!-- left profile info section -->
                            <div class="col-lg-3 col-12 order-2 order-lg-1">
                                <!-- about -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">About</h5>
                                        <p class="card-text">
                                            Tart I love sugar plum I love oat cake. Sweet ⭐️ roll caramels I love jujubes. Topping cake wafer.
                                        </p>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Joined:</h5>
                                            <p class="card-text">November 15, 2015</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Lives:</h5>
                                            <p class="card-text">New York, USA</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Email:</h5>
                                            <p class="card-text">bucketful@fiendhead.org</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-50">Website:</h5>
                                            <p class="card-text mb-0">www.pixinvent.com</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ about -->
                            </div>
                            <!--/ left profile info section -->

                            <!-- center profile info section -->
                            <div class="col-lg-6 col-12 order-1 order-lg-2">
                                <!-- post 1 -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-start align-items-center mb-1">
                                            <!-- avatar -->
                                            <div class="avatar mr-1">
                                                <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-18.jpg')}}" alt="avatar img" height="50" width="50" />
                                            </div>
                                            <!--/ avatar -->
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Leeanna Alvord</h6>
                                                <small class="text-muted">12 Dec 2018 at 1:16 AM</small>
                                            </div>
                                        </div>
                                        <p class="card-text">
                                            Wonderful Machine· A well-written bio allows viewers to get to know a photographer beyond the work. This
                                            can make the difference when presenting to clients who are looking for the perfect fit.
                                        </p>

                                        <!-- comment box -->
                                        <fieldset class="form-label-group mb-75">
                                            <textarea class="form-control" id="label-textarea" rows="3" placeholder="Add Comment"></textarea>
                                            <label for="label-textarea">Add Comment</label>
                                        </fieldset>
                                        <!--/ comment box -->
                                        <button type="button" class="btn btn-sm btn-primary">Post Comment</button>
                                    </div>
                                </div>
                                <!--/ post 1 -->
                            </div>
                            <!--/ center profile info section -->

                            <!-- right profile info section -->
                            <div class="col-lg-3 col-12 order-3">
                                <!-- suggestion -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Suggestions</h5>
                                        <div class="d-flex justify-content-start align-items-center mt-2">
                                            <div class="avatar mr-75">
                                                <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-9.jpg')}}" alt="avatar" height="40" width="40" />
                                            </div>
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Peter Reed</h6>
                                                <small class="text-muted">6 Mutual Friends</small>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-icon btn-sm ml-auto">
                                                <i data-feather="user-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mt-1">
                                            <div class="avatar mr-75">
                                                <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-6.jpg')}}" alt="avtar img holder" height="40" width="40" />
                                            </div>
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Harriett Adkins</h6>
                                                <small class="text-muted">3 Mutual Friends</small>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm btn-icon ml-auto">
                                                <i data-feather="user-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mt-1">
                                            <div class="avatar mr-75">
                                                <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="40" width="40" />
                                            </div>
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Juan Weaver</h6>
                                                <small class="text-muted">1 Mutual Friends</small>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary btn-icon ml-auto">
                                                <i data-feather="user-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mt-1">
                                            <div class="avatar mr-75">
                                                <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-8.jpg')}}" alt="avatar img" height="40" width="40" />
                                            </div>
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Claudia Chandler</h6>
                                                <small class="text-muted">16 Mutual Friends</small>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary btn-icon ml-auto">
                                                <i data-feather="user-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mt-1">
                                            <div class="avatar mr-75">
                                                <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-1.jpg')}}" alt="avatar img" height="40" width="40" />
                                            </div>
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Earl Briggs</h6>
                                                <small class="text-muted">4 Mutual Friends</small>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary btn-icon ml-auto">
                                                <i data-feather="user-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mt-1">
                                            <div class="avatar mr-75">
                                                <img src="{{asset('public/app-assets/images/portrait/small/avatar-s-10.jpg')}}" alt="avatar img" height="40" width="40" />
                                            </div>
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Jonathan Lyons</h6>
                                                <small class="text-muted">25 Mutual Friends</small>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary btn-icon ml-auto">
                                                <i data-feather="user-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ suggestion -->

                            </div>
                            <!--/ right profile info section -->
                        </div>
                    </section>
                    <!--/ profile info section -->
                </div>

            </div>
        </div>
   
    <!-- END: Content-->


@stop

@section('js_link')
