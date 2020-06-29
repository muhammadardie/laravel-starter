<div class="sidebar sidebar-style-2" data-background-color="dark2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img 
                        src="{{ !empty(Auth::user()->photo) ? 
                                asset('uploaded_files/user') .'/'. Auth::user()->photo :
                                asset('assets/uploaded_files/no-image.png')  
                            }}"
                        alt="..." class="avatar-img rounded-circle" 
                    />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->role->name }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile" class="edit-profile-account">
                                    <span class="link-collapse">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings" class="edit-password-account">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings" class="delete-account">
                                    <span class="link-collapse">Delete Account</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                @foreach($menus as $parent)
                    @if(empty($parent['menu']))
                        <li class="nav-item {{ $parent['active'] ? 'active' : '' }}">
                            <a href="{{ Route::has($parent['route']. '.index') ? route($parent['route']. '.index') : 'javascript:;' }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item {{ $parent['active'] ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#{{ $parent['menu_id'] }}">
                            <i class="{{ $parent['icon'] }}"></i>
                            <p>{{ $parent['name'] }}</p>
                            <span class="caret caret-right"></span>
                        </a>
                        <div class="collapse {{ $parent['active'] ? 'show' : '' }}" id="{{ $parent['menu_id'] }}">
                            <ul class="nav nav-collapse">

                                @foreach($parent['menu'] as $menu)

                                    @if(empty($menu['submenu']))
                                        <li class="{{ $menu['active'] ? 'active' : '' }}">
                                            <a href="{{ Route::has($menu['route']. '.index') ? route($menu['route']. '.index') : 'javascript:;' }}">
                                                <span class="sub-item">{{ $menu['name'] }}</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a data-toggle="collapse" href="#{{ $menu['menu_id'] }}" style="{{ $menu['active'] ? 'background: rgba(199,199,199,.2)' : '' }}">
                                                <span class="sub-item">{{ $menu['name'] }}</span>
                                                <span class="caret"></span>
                                            </a>
                                            <div class="collapse {{ $menu['active'] ? 'show' : '' }}" id="{{ $menu['menu_id'] }}">
                                                <ul class="nav nav-collapse" style="padding:10px">
                                                    @foreach($menu['submenu'] as $submenu)
                                                        <li class="{{ $submenu['active'] ? 'active' : '' }}">
                                                            <a href="{{ Route::has($submenu['route']. '.index') ? route($submenu['route']. '.index') : 'javascript:;' }}">
                                                                <span class="sub-item">{{ $submenu['name'] }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endif
                    
                @endforeach
            </ul>
        </div>
    </div>
</div>
