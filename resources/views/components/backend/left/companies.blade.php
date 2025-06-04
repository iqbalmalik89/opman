    @if(Auth::user()->hasPermissionTo('view companies'))

                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Nav::isRoute('tenants')}}" href="{{route('tenants')}}">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                                
                                                <i class="fa-solid fa-city text-white"></i>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Companies</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
    @endif