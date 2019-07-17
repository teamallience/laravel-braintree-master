<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @foreach(config('consts.ADMIN.SIDEBAR') as $key=> $menu)
                    <li class="nav-devider"></li>
                    @if($key == 'BREAKER')
                        <li class="nav-small-cap"> {{$menu['TITLE']}}</li>
                    @else
                        <li class="@if($page_info['menu'] == $key)  active @endif">
                            <a class="waves-effect waves-dark @if(isset($menu['CHILDREN'])) has-arrow  @endif" @if(isset($menu['CHILDREN'])) href="#" aria-expanded="false"  @else href="{{route($menu['LOCATION'])}}" @endif ><i class="{{$menu['ICON']}}"></i><span class="hide-menu">{{$menu['TITLE']}} </a>
                                @if(isset($menu['CHILDREN']))
                                    <ul aria-expanded="false" class="collapse">
                                        @foreach($menu['CHILDREN'] as $subkey=>$submenu)
                                            <li><a href="{{$submenu['LOCATION']}}">{{$submenu['TITLE']}}</a></li>
                                        @endforeach
                                    </ul>
                                @endif

                        </li>        

                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
