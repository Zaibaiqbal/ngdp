<!-- Header top area start-->
<style>
.activeclass{
  background: white;
    color: #a24187 !important;
}
.header-top-area ul li a{
color:black !important;
}
.header-top-area{
    box-shadow: white !important;
}


</style>
<div class="header-top-area" style="background-color: transparent;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              
            </div>
            <div class="col-lg-6 col-md-7 col-sm-0 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav mai-top-nav" style="font-weight:bold !important;">
                         <li class="nav-item"><a class="{{ Request::segment(1) === 'viewtheme' ? 'activeclass' : null }} {{ Request::segment(1) === 'home' ? 'activeclass' : null }}" href="{{ route('home')}}" class="nav-link">Gender Statistics</a>
                        </li>

                        <!-- <li class="nav-item"><a href="#" class="nav-link">About</a>
                        </li> -->

                        @if(Request::segment(1) != "knowledgehub")
                            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data','View Data']))
                                <li class="nav-item">
                                    <a href="{{url('knowledgehub')}}" class="nav-link {{ Request::segment(1) === 'knowledgehub' ? 'activeclass' : null }}">Knowledge Hub</a>
                                </li>
                            @else
                                @if(!isset(Auth::user()->id) )
                                <li class="nav-item">
                                    <a href="{{url('knowledgehub')}}" class="nav-link {{ Request::segment(1) === 'knowledgehub' ? 'activeclass' : null }}">Knowledge Hub</a>
                                </li>
                                @endif
                            @endif
                        @elseif(Request::segment(1) == "knowledgehub")
                            @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add / Edit / Delete Data','View Data']))
                                <li class="nav-item">
                                    <a href="{{url('knowledgehub')}}" class="nav-link {{ Request::segment(1) === 'knowledgehub' ? 'activeclass' : null }}">Knowledge Hub</a>
                                </li>
                            @else
                                @if(!isset(Auth::user()->id) )
                                <li class="nav-item">
                                    <a href="{{url('knowledgehub')}}" class="nav-link {{ Request::segment(1) === 'knowledgehub' ? 'activeclass' : null }}">Knowledge Hub</a>
                                </li>
                                @endif
                            @endif
                        @endif


                        <li class="nav-item"><a href="{{asset('map/index.html')}}" class="nav-link {{ Request::segment(1) === 'gismap' ? 'activeclass' : null }}" target="_blank" class="nav-link">GIS Map</a>
                        </li>


                        @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','View Logs']))
                        <li class="nav-item"><a href="{{ route('logs')}}" target="_blank" class="nav-link {{ Request::segment(1) === 'logs' ? 'activeclass' : null }}">Logs</a>
                        </li>
                        @endif

                        @if(Auth::guest())
                        <li class="nav-item pull-right"><a href="{{ route('login')}}"  class="nav-link {{ Request::segment(1) === 'logs' ? 'activeclass' : null }}">Login</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>

            @if(isset(Auth::user()->id))
            <div class="col-lg-3 col-md-7 col-sm-6 col-xs-12">
                <div class="header-right-info">
                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                      @if(Request::segment(1) == "home")
                      <li class="nav-item"><a href="#" class="nav-link" onclick="showsearch()" style="font-size:15px;"><i class="fa fa-search"></i> Search</a>
                      </li>
                      @endif
                      @if(Request::segment(1) == "knowledgehub")
                      <li class="nav-item"><a href="#" class="nav-link" onclick="showsearch2()"><i class="fa fa-search"></i></a>
                      </li>
                      @endif
                        <li class="nav-item">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                <span class="admin-name" style="color:black">

                                        {{ Auth::user()->name}}
                                </span>
                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                            </a>
                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                <!-- <li><a href="#"><span class="adminpro-icon adminpro-home-admin author-log-ic"></span>My Account</a> -->
                                <!-- </li> -->
                                <!-- <li><a href="#"><span class="adminpro-icon adminpro-user-rounded author-log-ic"></span>My Profile</a> -->
                                <!-- </li> -->
                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Add Roles','Update Roles']))
                                    <li><a class="{{ Request::segment(1) === 'roles' ? 'cus-active' : null }}" href="{{ route('roles')}}"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Roles & Permissions</a>
                                    </li>
                                @endif

                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Approve / Reject Users']))
                                    <li><a class="{{ Request::segment(1) === 'registerlist' ? 'cus-active' : null }}" href="{{ route('registerlist')}}"><span class="adminpro-icon adminpro-users author-log-ic"></span>Approve / Reject Users</a>
                                    </li>
                                @endif

                                @if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Registered Users']))
                                    <li><a class="{{ Request::segment(1) === 'userlist' ? 'cus-active' : null }}" href="{{ route('userlist')}}"><span class="adminpro-icon adminpro-users author-log-ic"></span>Registered Users</a>
                                    </li>
                                @endif
                              <!--   <li><a href="#"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Settings</a>
                                </li> -->
                                <li><a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" href="#"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            @endif


        </div>
    </div>
</div>
<!-- Header top area end-->
