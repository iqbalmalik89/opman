@if(Auth::user()->hasPermissionTo('view dashboard'))

    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{Nav::isRoute('dashboard')}}" href="{{route('dashboard')}}">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                
                <i class="fa-solid fa-chart-column text-white"></i>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Dashboard</span>
        </a>
        <!--end:Menu link-->
    </div>

@endif