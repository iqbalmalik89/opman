@if(Auth::user()->hasPermissionTo('people search'))

									<div class="menu-item active">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('people')}}" href="{{route('people')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-search text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">People Search</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif