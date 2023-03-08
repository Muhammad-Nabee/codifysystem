 BEGIN: Header-->

    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">

        <div class="navbar-container d-flex content">

            <div class="bookmark-wrapper d-flex align-items-center">

                <ul class="nav navbar-nav d-xl-none">

                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>

                </ul>

                <ul class="nav navbar-nav bookmark-icons">

                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon" data-feather="mail"></i></a></li>

                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>

                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>

                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>

                </ul>

                <ul class="nav navbar-nav">

                    <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>

                        <div class="bookmark-input search-input">

                            <div class="bookmark-input-icon"><i data-feather="search"></i></div>

                            <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">

                            <ul class="search-list search-list-bookmark"></ul>

                        </div>

                    </li>

                </ul>

            </div>

            <ul class="nav navbar-nav align-items-center ml-auto">

                <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>

                </li>

                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>

                <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>

                    <div class="search-input">

                        <div class="search-input-icon"><i data-feather="search"></i></div>

                        <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">

                        <div class="search-input-close"><i data-feather="x"></i></div>

                        <ul class="search-list search-list-main"></ul>

                    </div>

                </li>

                <li class="nav-item dropdown dropdown-cart mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span class="badge badge-pill badge-primary badge-up cart-item-count">6</span></a>

                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">

                        <li class="dropdown-menu-header">

                            <div class="dropdown-header d-flex">

                                <h4 class="notification-title mb-0 mr-auto">My Cart</h4>

                                <div class="badge badge-pill badge-light-primary">4 Items</div>

                            </div>

                        </li>

                        <li class="scrollable-container media-list">

                            <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{asset('public/app-assets/images/pages/eCommerce/1.png')}}" alt="donuts" width="62">

                                <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>

                                    <div class="media-heading">

                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Apple watch 5</a></h6><small class="cart-item-by">By Apple</small>

                                    </div>

                                    <div class="cart-item-qty">

                                        <div class="input-group">

                                            <input class="touchspin-cart" type="number" value="1">

                                        </div>

                                    </div>

                                    <h5 class="cart-item-price">$374.90</h5>

                                </div>

                            </div>

                            <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{asset('public/app-assets/images/pages/eCommerce/7.png')}}" alt="donuts" width="62">

                                <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>

                                    <div class="media-heading">

                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Google Home Mini</a></h6><small class="cart-item-by">By Google</small>

                                    </div>

                                    <div class="cart-item-qty">

                                        <div class="input-group">

                                            <input class="touchspin-cart" type="number" value="3">

                                        </div>

                                    </div>

                                    <h5 class="cart-item-price">$129.40</h5>

                                </div>

                            </div>

                            <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{asset('public/app-assets/images/pages/eCommerce/2.png')}}" alt="donuts" width="62">

                                <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>

                                    <div class="media-heading">

                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iPhone 11 Pro</a></h6><small class="cart-item-by">By Apple</small>

                                    </div>

                                    <div class="cart-item-qty">

                                        <div class="input-group">

                                            <input class="touchspin-cart" type="number" value="2">

                                        </div>

                                    </div>

                                    <h5 class="cart-item-price">$699.00</h5>

                                </div>

                            </div>

                            <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{asset('public/app-assets/images/pages/eCommerce/3.png')}}" alt="donuts" width="62">

                                <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>

                                    <div class="media-heading">

                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iMac Pro</a></h6><small class="cart-item-by">By Apple</small>

                                    </div>

                                    <div class="cart-item-qty">

                                        <div class="input-group">

                                            <input class="touchspin-cart" type="number" value="1">

                                        </div>

                                    </div>

                                    <h5 class="cart-item-price">$4,999.00</h5>

                                </div>

                            </div>

                            <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{asset('public/app-assets/images/pages/eCommerce/5.png')}}" alt="donuts" width="62">

                                <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>

                                    <div class="media-heading">

                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> MacBook Pro</a></h6><small class="cart-item-by">By Apple</small>

                                    </div>

                                    <div class="cart-item-qty">

                                        <div class="input-group">

                                            <input class="touchspin-cart" type="number" value="1">

                                        </div>

                                    </div>

                                    <h5 class="cart-item-price">$2,999.00</h5>

                                </div>

                            </div>

                        </li>

                        <li class="dropdown-menu-footer">

                            <div class="d-flex justify-content-between mb-1">

                                <h6 class="font-weight-bolder mb-0">Total:</h6>

                                <h6 class="text-primary font-weight-bolder mb-0">$10,999.00</h6>

                            </div><a class="btn btn-primary btn-block" href="app-ecommerce-checkout.html">Checkout</a>

                        </li>

                    </ul>

                </li>
                <!-- notification start -->
                <li class="nav-item dropdown dropdown-notification mr-25 "><a  class="nav-link"  data-toggle="dropdown"><i class="ficon notice"  data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up"><div class="total"></div></span></a>

                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">

                        <li class="dropdown-menu-header">

                            <div class="dropdown-header d-flex">

                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                <div class="new"></div>
                            </div>

                        </li>

                        <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                            <div class="noti"></div>
                                

                                    
                                    

                                       

                                    


                        </li>

                        <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>

                    </ul>

                </li>
                <!-- notification end --> 

                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">
                            {{ session('status')->user_name??'' }}</span>
                            

                            @if(session('status')->role_id==1)

                            <span class="user-status">Admin</span>

                            @elseif(session('status')->role_id==2)
                            
                            <span class="user-status">Employee</span>
                            @endif
                            </div>

                        @if(session('status')->image==null)

                        <span class="avatar"><img class="round" src="{{asset('public/app-assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>

                        @elseif(session('status')->image!=null)
                        <span class="avatar"><img class="round" src="https://system.codify.pk/public/userprofile/{{session('status')->image}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>

                        @endif
                        

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="{{route('Userprofile')}}"><i class="mr-50" data-feather="user"></i> Profile</a><a class="dropdown-item" href="app-email.html"><i class="mr-50" data-feather="mail"></i> Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="mr-50" data-feather="check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="mr-50" data-feather="message-square"></i> Chats</a>

                        <div class="dropdown-divider"></div><a class="dropdown-item" href="page-account-settings.html"><i class="mr-50" data-feather="settings"></i> Settings</a><a class="dropdown-item" href="page-pricing.html"><i class="mr-50" data-feather="credit-card"></i> Pricing</a><a class="dropdown-item" href="page-faq.html"><i class="mr-50" data-feather="help-circle"></i> FAQ</a><a class="dropdown-item" href="logout"><i class="mr-50" data-feather="power"></i> Logout</a>

                    </div>

                </li>

            </ul>

        </div>

    </nav>

    <ul class="main-search-list-defaultlist d-none">

        <li class="d-flex align-items-center"><a href="javascript:void(0);">

                <h6 class="section-label mt-75 mb-0">Files</h6>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">

                <div class="d-flex">

                    <div class="mr-75"><img src="{{asset('public/app-assets/images/icons/xls.png')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>

                    </div>

                </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">

                <div class="d-flex">

                    <div class="mr-75"><img src="{{asset('public/app-assets/images/icons/jpg.png')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>

                    </div>

                </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">

                <div class="d-flex">

                    <div class="mr-75"><img src="{{asset('public/app-assets/images/icons/pdf.png')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>

                    </div>

                </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">

                <div class="d-flex">

                    <div class="mr-75"><img src="{{asset('public/app-assets/images/icons/doc.png')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>

                    </div>

                </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small>

            </a></li>

        <li class="d-flex align-items-center"><a href="javascript:void(0);">

                <h6 class="section-label mt-75 mb-0">Members</h6>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">

                <div class="d-flex align-items-center">

                    <div class="avatar mr-75"><img src="{{asset('public/app-assets/images/portrait/small/avatar-s-8.jpg')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">{{session('user')?session('user')->user_name:""}}</p><small class="text-muted">UI designer</small>

                    </div>

                </div>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">

                <div class="d-flex align-items-center">

                    <div class="avatar mr-75"><img src="{{asset('public/app-assets/images/portrait/small/avatar-s-1.jpg')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>

                    </div>

                </div>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">

                <div class="d-flex align-items-center">

                    <div class="avatar mr-75"><img src="{{asset('public/app-assets/images/portrait/small/avatar-s-14.jpg')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>

                    </div>

                </div>

            </a></li>

        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">

                <div class="d-flex align-items-center">

                    <div class="avatar mr-75"><img src="{{asset('public/app-assets/images/portrait/small/avatar-s-6.jpg')}}" alt="png" height="32"></div>

                    <div class="search-data">

                        <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>

                    </div>

                </div>

            </a></li>

    </ul>

    <ul class="main-search-list-defaultlist-other-list d-none">

        <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">

                <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span></div>

            </a></li>

    </ul>



    <!-- END: Header