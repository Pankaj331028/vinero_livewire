<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn">
    <i class="la la-close">
    </i>
</button>
<div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{route('index')}}">
                <img alt="Logo" class="w-100 p-3" src="{{asset('images/logo.png')}}"/>
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span>
                    <svg class="kt-svg-icon" height="24px" version="1.1" viewbox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24">
                            </polygon>
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" id="Path-94" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) ">
                            </path>
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" id="Path-94" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) ">
                            </path>
                        </g>
                    </svg>
                </span>
                <span>
                    <svg class="kt-svg-icon" height="24px" version="1.1" viewbox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24">
                            </polygon>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" id="Path-94">
                            </path>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" id="Path-94" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) ">
                            </path>
                        </g>
                    </svg>
                </span>
            </button>
            <!--
            <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
            -->
        </div>
    </div>
    <!-- end:: Aside -->
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div class="kt-aside-menu " data-ktmenu-dropdown-timeout="500" data-ktmenu-scroll="1" data-ktmenu-vertical="1" id="kt_aside_menu">
            <ul class="kt-menu__nav ">
             <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'index') !== false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{route('index')}}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-dashboard"></i>
                        </span>
                        <span class="kt-menu__link-text">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">
                        Master
                    </h4>
                    <i class="kt-menu__section-icon flaticon-more-v2">
                    </i>
                </li>

                <li class="kt-menu__item kt-menu__item--submenu kt-menu__item @if(stripos(URL::current(),'home') !== false) kt-menu__item--open @endif" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">CMS</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="120" style=""><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @foreach($pages as $slug=>$page)
                            <li class="kt-menu__item @if(stripos(URL::current(),$slug) !== false) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('pages.edit',['slug'=>$slug]) }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{$page}}</span></a></li>
                            @endforeach
                            <li class="kt-menu__item @if(stripos(URL::current(),'faq') !== false) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('faq') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">FAQs</span></a></li>
                            <li class="kt-menu__item @if(stripos(URL::current(),'edit-sellerservice') !== false) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('edit-sellerservice') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Seller Services</span></a></li>
                            <li class="kt-menu__item @if(stripos(URL::current(),'edit-buyerservice') !== false) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('edit-buyerservice') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Buyer Services</span></a></li>
                            
                            {{-- <li class="kt-menu__item @if(stripos(URL::current(),'slider') !== false) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('slider') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Slider</span></a></li>
                            <li class="kt-menu__item @if(stripos(URL::current(),'fImage') !== false) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('fImage') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{env('APP_NAME')}} Featured Images</span></a></li>
                            <li class="kt-menu__item @if(stripos(URL::current(),'pImage') !== false) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('pImage') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{env('APP_NAME')}} Partner Images</span></a></li> --}}
                        </ul> 
                    </div>
                </li>

                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'') !== false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('contactus') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                            Contact Us
                        </span>
                    </a>
                </li>

                @if(Auth::guard('admin')->user()->user_role->name=='admin')
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'account') !== false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('accounts') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                            MANAGERS
                        </span>
                    </a>
                </li>
                @endif
                @if(Helper::checkAccess('list buyer'))
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'buyer') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ url('admin/buyers?status=1') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                            BUYERS
                        </span>
                    </a>
                </li>
                @endif


                @if(Helper::checkAccess('list seller'))
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'seller') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ url('admin/sellers?status=1') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                            SELLERS
                        </span>
                    </a>
                </li>
                @endif


                @if(Helper::checkAccess('list agent'))
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'agent') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{  url('admin/agents?status=1') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                            AGENTS
                        </span>
                    </a>
                </li>
                @endif



                @if(Helper::checkAccess(['list all_property','list active_property','list farm_property']))
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'properties') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('properties', 'state=ALL') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                          PROPERTIES
                        </span>
                    </a>
                </li>
                @endif


                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'resource') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('resource') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                          RESOURCES
                        </span>
                    </a>
                </li>


                @if(Helper::checkAccess('list notification'))
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'notifications') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('notifications') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                          NOTIFICATIONS
                        </span>
                    </a>
                </li>
                @endif

                @if(Helper::checkAccess('list survey'))
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'survey') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('survey') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                          SURVEYS
                        </span>
                    </a>
                </li>
                @endif


                @if(Helper::checkAccess('list report'))
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'reports') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('reports') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                          REPORTS
                        </span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->user_role->name=='admin')
                <li aria-haspopup="true" class="kt-menu__item @if(stripos(URL::current(),'settings') !== false && stripos(URL::current(),'account') === false) kt-menu__item--active @endif">
                    <a class="kt-menu__link " href="{{ route('settings') }}">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-folder"></i>
                        </span>
                        <span class="kt-menu__link-text">
                          SETTINGS
                        </span>
                    </a>
                </li>
                @endif


            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->