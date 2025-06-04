@if(Auth::user()->hasPermissionTo('site listing'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('sites')}}  {{Nav::isRoute('update-site')}}" href="{{route('sites')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-list text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Manage Sites</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif