@if(Auth::user()->hasPermissionTo('site search'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('site-search')}}" href="{{route('site-search')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												<i class="fa-solid fa-search text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Site Search</span>
										</a>
										<!--end:Menu link-->
									</div>

@endif