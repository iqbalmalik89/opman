@if(Auth::user()->hasPermissionTo('view subcontractor teams'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('subcontractor-teams')}}" href="{{route('subcontractor-teams')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												<i class="fa-solid fa-users-gear text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Manage Sub-Teams</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif