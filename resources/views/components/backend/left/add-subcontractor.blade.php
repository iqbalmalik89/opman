		@if(Auth::user()->hasPermissionTo('add subcontractor'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('create-subcontractor')}}" href="{{route('create-subcontractor')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-universal-access text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Add Subcontractor</span>
										</a>
										<!--end:Menu link-->
									</div>
		@endif