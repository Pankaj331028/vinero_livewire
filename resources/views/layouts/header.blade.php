<!-- begin:: Header -->

<div class="kt-header kt-grid__item kt-header--fixed " id="kt_header">

    <!-- begin:: Header Menu -->

    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn">

        <i class="la la-close">

        </i>

    </button>

    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->

    <div class="kt-header__topbar">

        <!--end: Notifications -->

        <!--begin: Quick Actions -->
        @if(Helper::checkAccess('list notification'))
        <div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false">
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                        </g>
                    </svg> <span class="kt-pulse__ring"></span>
                </span>

                <!--
                    Use dot badge instead of animated pulse effect:
                    <span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span>
                    -->
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(44px, 64px, 0px);">
                <form>

                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-image: url({{URL::asset('images/misc/bg-1.jpg')}})">
                        <h3 class="kt-head__title">
                            Admin Notifications
                            &nbsp;
                            <span class="btn btn-success btn-sm btn-bold btn-font-md">{{$total_notification ?? '0'}} new</span>
                        </h3>
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">New offer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">New Property</a>
                            </li>
                            @if (isset($new_offer_improve))
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_ev" role="tab" aria-selected="false">Offer Improve</a>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <!--end: Head -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll ps" data-scroll="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">
                                @if (isset($new_offer))
                                @foreach ($new_offer as $offer)
                                <a href="{{route('view_notification', [$offer->id])}}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-line-chart kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            {{$offer['data']['title'] ?? ''}}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                        </div>
                        <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll ps" data-scroll="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">
                                @if (isset($new_property))
                                @foreach ($new_property as $offer)
                                <a href="{{route('view_notification', [$offer->id])}}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-line-chart kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            {{$offer['data']['title'] ?? ''}}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                        </div>
                        <div class="tab-pane" id="topbar_notifications_ev" role="tabpanel">
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll ps" data-scroll="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">
                                @if (isset($new_offer_improve))
                                @foreach ($new_offer_improve as $offer)
                                <a href="{{route('view_notification', [$offer->id])}}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-line-chart kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            {{$offer['data']['title'] ?? ''}}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
                            <div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <!--end: Quick Actions -->

        <!--begin: User Bar -->

        <div class="kt-header__topbar-item kt-header__topbar-item--user">

            <div class="kt-header__topbar-wrapper" data-offset="0px,0px" data-toggle="dropdown">

                <div class="kt-header__topbar-user">

                    <span class="kt-header__topbar-welcome kt-hidden-mobile">

                        Hi,

                    </span>

                    <span class="kt-header__topbar-username kt-hidden-mobile">

                        {{Auth::guard('admin')->user()->name}}

                    </span>

                    <img alt="Pic" src="{{URL::asset('images/default.jpg')}}"/>

                </div>

            </div>

            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->

                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{URL::asset('images/misc/bg-1.jpg')}})">

                    <div class="kt-user-card__avatar">

                        <img alt="Pic" src="{{URL::asset('images/default.jpg')}}"/>



                    </div>

                    <div class="kt-user-card__name">

                        {{Auth::guard('admin')->user()->name}}

                    </div>

                </div>

                <!--end: Head -->

                <!--begin: Navigation -->

                <div class="kt-notification">

                    <a class="kt-notification__item" href="{{route('change-password')}}">

                        <div class="kt-notification__item-icon">

                            <i class="flaticon-lock kt-font-warning">

                            </i>

                        </div>

                        <div class="kt-notification__item-details">

                            <div class="kt-notification__item-title kt-font-bold">

                                Change Password

                            </div>

                        </div>

                    </a>

                    <div class="kt-notification__custom kt-space-between">

                        <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{route('logout')}}">

                            Sign Out

                        </a>

                    </div>

                </div>

                <!--end: Navigation -->

            </div>

        </div>

        <!--end: User Bar -->

    </div>

    <!-- end:: Header Topbar -->

</div>

<!-- end:: Header -->

