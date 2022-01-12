<div class="app-sidebar menu-fixed" data-background-color="man-of-steel" data-image="{{ asset('saller-assets/app-assets/img/sidebar-bg/01.jpg') }}" data-scroll-to-active="true">
   <div class="sidebar-header">
      <div class="logo clearfix"><a class="logo-text float-left" href="{{route('college.dashboard')}}">
            <div class="logo-img">College Panel</div>

         </a><a class="nav-toggle d-none d-lg-none d-xl-block" id="sidebarToggle" href="javascript:;"><i class="toggle-icon ft-toggle-right" data-toggle="expanded"></i></a><a class="nav-close d-block d-lg-block d-xl-none" id="sidebarClose" href="javascript:;"><i class="ft-x"></i></a></div>
   </div>
   <div class="sidebar-content main-menu-content">
      <div class="nav-container">
         <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Dashboard -->
            <li class=" nav-item {{ request()->is('*dashboard*') ? 'active' : '' }}"><a href="{{ route('college.dashboard') }}" class="text-decoration-none"><i class="ft-home"></i><span class="menu-title" data-i18n="Chat">Dashboard</span></a>
               <!-- <li class="has-sub nav-item"><a href="javascript:;"><i class="ft-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="tag badge badge-pill badge-danger float-right mr-1 mt-1">2</span></a>
               <ul class="menu-content">
                  <li class="active"><a href="{{ route('college.dashboard') }}"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item" data-i18n="Dashboard 1">Dashboard 1</span></a>
                  </li>
                  <li><a href="dashboard2.html"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item" data-i18n="Dashboard 2">Dashboard 2</span></a>
                  </li>
               </ul>
            </li> -->
            <li class="{{ request()->is('*course*') ? 'active' : '' }}">
               <a href="{{route('college.course.index')}}" class="text-decoration-none">
                  <i class="fa fa-shopping-basket"></i>
                  <span class="menu-title" data-i18n="Email">College Courses</span>
               </a>
            </li>
            <li class="{{ request()->is('*merit*') ? 'active' : '' }}">
               <a href="{{route('college.merit.index')}}" class="text-decoration-none">
                  <i class="fa fa-shopping-basket"></i>
                  <span class="menu-title" data-i18n="Email">College Merit</span>
               </a>
            </li>
         </ul>
      </div>
   </div>
   <div class="sidebar-background"></div>
</div>
