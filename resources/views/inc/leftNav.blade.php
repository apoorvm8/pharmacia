<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{asset('assets/adminPanel/images/user.png')}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::guard('admin')->user()->firstName . " " . Auth::guard('admin')->user()->lastName}}</div>
            <div class="email">{{Auth::guard('admin')->user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="seperator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Sign Out') }}
                        </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{active('admin.dashboard')}}">
                <a href="{{route('admin.dashboard', ['admin' => 'admin'])}}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
           
            <li class="{{active(['medicine.*', 'content.*'])}}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">widgets</i>
                    <span>Medicine Category</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{active('medicine.*')}}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Medicine</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{active('medicine.view')}}">
                                <a href="{{route('medicine.view', ['admin' => 'admin'])}}">View All</a>
                            </li>
                            <li class="{{active('medicine.add')}}">
                                <a href="{{route('medicine.add', ['admin' => 'admin'])}}">Add Medicine</a>
                            </li>
                            <li class="{{active('medicine.deleteView')}}">
                                <a href="{{route('medicine.deleteView', ['admin' => 'admin'])}}">Delete Medicine</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{active('content.*')}}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Content</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{active('content.view')}}">
                                <a href="{{route('content.view', ['admin' => 'admin'])}}">View All</a>
                            </li>
                            <li class="{{active('content.add')}}">
                                <a href="{{route('content.add', ['admin' => 'admin'])}}">Add Content</a>
                            </li>
                            <li class="{{active('content.deleteView')}}">
                                <a href="{{route('content.deleteView', ['admin' => 'admin'])}}">Delete Content</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="{{active(['article.*'])}}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">widgets</i>
                    <span>Articles</span>
                </a>
                {{-- <ul class="ml-menu"> --}}
                    {{-- <li class="{{active('article.*')}}"> --}}
                        {{-- <a href="javascript:void(0);" class="menu-toggle">
                            <span>A</span>
                        </a> --}}
                        <ul class="ml-menu">
                            <li class="{{active('article.view')}}">
                                <a href="{{route('article.view', ['admin' => 'admin'])}}">View All</a>
                            </li>
                            <li class="{{active('article.add')}}">
                                <a href="{{route('article.add', ['admin' => 'admin'])}}">Add Article</a>
                            </li>
                        </ul>
                    {{-- </li> --}}
                {{-- </ul> --}}
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 - 2019 <a href="javascript:void(0);">Pharmacia</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.1
        </div>
    </div>
    <!-- #Footer -->
</aside>