<nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-fixed">
    <div class="container-fluid navbar-wrapper">
        <div class="navbar-header d-flex">
            <div class="navbar-toggle menu-toggle d-xl-none d-block float-left align-items-center justify-content-center"
                data-toggle="collapse"><i class="ft-menu font-medium-3"></i></div>
            <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block"><a class="nav-link apptogglefullscreen" id="navbar-fullscreen"
                        href="javascript:;"><i class="ft-maximize font-medium-3"></i></a></li>
                <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="javascript:">
                        <i class="ft-search font-medium-3"></i></a>
                    <div class="search-input">
                        <div class="search-input-icon"><i class="ft-search font-medium-3"></i></div>
                        <input class="input" type="text" placeholder="Explore Apex..." tabindex="0"
                            data-search="template-search">
                        <div class="search-input-close"><i class="ft-x font-medium-3"></i></div>
                        <ul class="search-list"></ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="navbar-container">
            <div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <div class="col-md-6 col-12">
                    </div>
                    <li class="dropdown nav-item">
                        <a class="nav-link dropdown-toggle dropdown-notification p-0 mt-2 notifi" id="dropdownBasic1"
                            href="javascript:;" data-toggle="dropdown">
                            <i class="ft-bell font-medium-3"></i>
                            <span class="notification badge badge-pill badge-danger" id="count">
                                <!-- count notification -->
                            </span>
                        </a>
                        <ul
                            class="notification-dropdown dropdown-menu dropdown-menu-media dropdown-menu-right m-0 overflow-hidden">
                            <li class="dropdown-menu-header">
                                <div
                                    class="dropdown-header d-flex justify-content-between m-0 px-3 py-2 white bg-primary">
                                    <div class="d-flex"><i
                                            class="ft-bell font-medium-3 d-flex align-items-center mr-2"></i><span
                                            class="noti-title" id="count"> New Notification</span></div>
                                    <!-- <span class="text-bold-400 cursor-pointer">Mark all as read</span> -->
                                </div>
                            </li>
                            <li class="scrollable-container"><a class="d-flex justify-content-between"
                                    href="javascript:void(0)">
                                    <div class="media d-flex align-items-center">
                                        <!-- <div class="media-left">
                                 <div class="mr-3"><img class="avatar" src="{{ asset('saller-assets/app-assets/img/portrait/small/pic-8.png') }}" alt="avatar" height="45" width="45"></div>
                              </div> -->
                                        <div class="media-body appends" id="appends">
                                            <!-- message -->
                                        </div>
                                    </div>
                                </a>

                            </li>
                            <li class="dropdown-menu-footer">
                                <div
                                    class="noti-footer text-center cursor-pointer primary border-top text-bold-400 py-1">
                                    <!-- Read All Notifications -->
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item mr-1"><a
                            class="nav-link dropdown-toggle user-dropdown d-flex align-items-end" id="dropdownBasic2"
                            href="javascript:;" data-toggle="dropdown">
                            <div class="user d-md-flex d-none mr-2"><span class="text-right">College </span><span
                                    class="text-right text-muted font-small-3">Available</span></div>
                            <img class="avatar"
                                src="{{ asset('saller-assets/app-assets/img/portrait/small/default.png') }}"
                                alt="avatar" height="35" width="35">
                        </a>
                        <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                            aria-labelledby="dropdownBasic2"><a class="dropdown-item" href="app-chat.html">
                                <!-- <div class="d-flex align-items-center"><i -->
                                <!-- class="ft-message-square mr-2"></i><span>Chat</span></div> -->
                            </a>
                            <a class="dropdown-item" href="">
                                <div class="d-flex align-items-center"><i class="ft-edit mr-2"></i><span>Edit
                                        Profile</span></div>
                            </a>
                            <a class="dropdown-item" href="{{route('college.changePasswordGet')}}">
                                <div class="d-flex align-items-center"><i class="ft-mail mr-2"></i><span>Change
                                        Password</span></div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <p class="preview-subject mb-1" href="{{ route('college.college.logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</p>
                            <form action="{{ route('college.college.logout') }}" method="post" class="d-none" id="logout-form">
                                @csrf</form>
                        </div>
                    </li>
                    <form id="logout-form" action="" method="POST" class="d-none">
                        @csrf
                    </form>
                    {{-- <li class="nav-item d-none d-lg-block mr-2 mt-1"><a class="nav-link notification-sidebar-toggle" href="javascript:;"><i class="ft-align-right font-medium-3"></i></a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</nav>
