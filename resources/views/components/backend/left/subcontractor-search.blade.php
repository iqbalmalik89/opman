@if(Auth::user()->hasPermissionTo('subcontractor listing'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('subcontractor-search')}}" href="{{route('subcontractor-search')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												<i class="fa-solid fa-search text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Subcontractors Search</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif