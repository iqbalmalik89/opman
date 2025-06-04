@if(Auth::user()->hasPermissionTo('view settings'))
									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('deactivated')}}" href="{{route('deactivated')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-cog text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Deactivated</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif