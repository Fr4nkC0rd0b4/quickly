@php
    $menu = menu('front', '_json');
    $menus = Collect();
    
    foreach ($menu as $key => $value) {
        // dd($value->link());
        $permission = 'browse_' . explode('/', $value->link())[0];
        
        // if(Auth::user()->hasPermission($permission)){
            $menus->push($value);
        // }
    }
    // dd($menus);
@endphp
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu mm-show">
    <!-- LOGO -->
    <router-link to="/home">
        <a href="#" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="{{ asset('storage/'.setting('site.logo')) }}" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('storage/'.setting('site.logo_sm')) }}" alt="" height="16">
            </span>
        </a>
        <!-- LOGO DARK -->
        <a href="#" class="logo text-center logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('storage/'.setting('site.logo_dark')) }}" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('storage/'.setting('site.logo_sm_dark')) }}" alt="" height="16">
            </span>
        </a>
    </router-link>
    <div class="h-100 mm-active" id="left-side-menu-container" {{-- style="overflow: auto;" --}} data-simplebar="init">
        <div id="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>

            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <!--- Sidemenu -->
                            <ul class="metismenu side-nav mm-show">
                                @if ($menus && count($menus)>0)
                                    @foreach ($menus as $key => $menu_item)
                                        {{-- !head para link titulo principal --}}
                                        @if ($menu_item->link()=='!head')
                                            <li class="side-nav-title side-nav-item">{{ $menu_item->title }}</li>
                                        @else
                                            <li class="side-nav-item">
                                                @if ($menu_item->link() == '/home')
                                                    <router-link to="{{$menu_item->link()!==''?$menu_item->link():''}}">
                                                        <a href="#" class="side-nav-link">
                                                            @if($menu_item->icon_class != null)
                                                                <i class="{{$menu_item->icon_class}}"></i>
                                                            @endif
                                                            <span> {{ $menu_item->title }} </span>
                                                            @if ($menu_item->link()=='')
                                                                <i class="fa fa-arrow-down"></i>{{-- <span data-feather="chevron-right"></span> --}}
                                                            @endif
                                                        </a>
                                                    </router-link>
                                                @elseif (substr($menu_item->link(), 0,5)=='/spa/')
                                                    <router-link to="{{$menu_item->link()!==''?$menu_item->link():''}}">
                                                        <a href="#" class="side-nav-link">
                                                            @if($menu_item->icon_class != null)
                                                                <i class="{{$menu_item->icon_class}}"></i>
                                                            @endif
                                                            <span> {{ $menu_item->title }} </span>
                                                        </a>
                                                    </router-link>
                                                @else
                                                    @if($menu_item->target == '_blank')
                                                        <a href="{{ $menu_item->link()!==''?$menu_item->link():'javascript: void(0);' }}" class="side-nav-link" aria-expanded="false" {{-- onclick="dropDown()" --}} target="blank">
                                                    @else
                                                        <a href="{{ $menu_item->link()!==''?$menu_item->link():'javascript: void(0);' }}" class="side-nav-link" aria-expanded="false" {{-- onclick="dropDown()" --}}>
                                                    @endif
                                                        @if($menu_item->icon_class != null)
                                                            <i class="{{$menu_item->icon_class}}"></i>
                                                        @endif
                                                        <span>{{ $menu_item->title }}</span>
                                                        @if ($menu_item->link()=='')
                                                            <i class="float-right fa fa-angle-down"></i>
                                                        @endif
                                                    </a>
                                                @endif
                                                @if (count($menu_item->children)>0)
                                                    <ul class="side-nav-second-level mm-collapse" aria-expanded="false" style="height: 0px;">
                                                        @foreach ($menu_item->children as $menu_hijo)
                                                            <li>
                                                                @if (substr($menu_hijo->link(), 0,5)=='/spa/')
                                                                    <router-link to="{{$menu_hijo->link()}}">
                                                                        {{$menu_hijo->title}}
                                                                    </router-link>
                                                                @else
                                                                    <li>
                                                                    <a href="{{$menu_hijo->link()}}">
                                                                        {{$menu_hijo->title}}
                                                                    </a>
                                                                    </li>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 1422px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar" style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->