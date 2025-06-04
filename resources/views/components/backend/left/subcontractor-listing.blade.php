
@if(Auth::user()->hasPermissionTo('subcontractor listing'))
	<div class="menu-item">
		<!--begin:Menu link-->
		<a class="menu-link {{Nav::isRoute('subcontractors')}} {{Nav::isRoute('update-suboperative')}} {{Nav::isRoute('create-suboperative')}} {{Nav::isRoute('update-subcontractor')}} {{Nav::isRoute('teams')}} {{Nav::isRoute('create-team')}} {{Nav::isRoute('update-team')}} {{Nav::isRoute('suboperatives')}}" href="{{route('subcontractors')}}">
			<span class="menu-icon">
				<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
				<i class="fa-solid fa-magnifying-glass-location text-white"></i>
				<!--end::Svg Icon-->
			</span>
			<span class="menu-title">Subcontractors</span>
		</a>
		<!--end:Menu link-->
	</div>
@endif